<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use App\Models\InvestmentApplication;

class InvestmentApplicationRateLimit
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();
        $email = $request->input('email');
        $nationalId = $request->input('national_id_residence_number');
        $crNumber = $request->input('commercial_registration_number');

        // Rate limiting by IP address (5 attempts per hour)
        $ipKey = 'investment_app_ip:' . $ip;
        if (RateLimiter::tooManyAttempts($ipKey, 5)) {
            return response()->json([
                'error' => __('validation.too_many_attempts_ip'),
                'retry_after' => RateLimiter::availableIn($ipKey)
            ], 429);
        }

        // Rate limiting by email (3 attempts per day)
        if ($email) {
            $emailKey = 'investment_app_email:' . $email;
            if (RateLimiter::tooManyAttempts($emailKey, 3)) {
                return response()->json([
                    'error' => __('validation.too_many_attempts_email'),
                    'retry_after' => RateLimiter::availableIn($emailKey)
                ], 429);
            }
        }

        // Check for duplicate applications within 24 hours
        if ($email) {
            $recentApplication = InvestmentApplication::where('email', $email)
                ->where('created_at', '>=', now()->subHours(24))
                ->first();

            if ($recentApplication) {
                return response()->json([
                    'error' => __('validation.duplicate_application'),
                    'reference_number' => $recentApplication->reference_number
                ], 422);
            }
        }

        // Check for duplicate National ID or CR number
        if ($nationalId) {
            $existingApp = InvestmentApplication::where('national_id_residence_number', $nationalId)->first();
            if ($existingApp) {
                return response()->json([
                    'error' => __('validation.national_id_exists'),
                    'reference_number' => $existingApp->reference_number
                ], 422);
            }
        }

        if ($crNumber) {
            $existingApp = InvestmentApplication::where('commercial_registration_number', $crNumber)->first();
            if ($existingApp) {
                return response()->json([
                    'error' => __('validation.cr_exists'),
                    'reference_number' => $existingApp->reference_number
                ], 422);
            }
        }

        // Suspicious activity detection
        $this->detectSuspiciousActivity($request);

        // Increment rate limiters on successful validation
        RateLimiter::hit($ipKey, 3600); // 1 hour
        if ($email) {
            RateLimiter::hit('investment_app_email:' . $email, 86400); // 24 hours
        }

        return $next($request);
    }

    /**
     * Detect suspicious activity patterns
     */
    private function detectSuspiciousActivity(Request $request): void
    {
        $ip = $request->ip();
        $userAgent = $request->userAgent();

        // Check for bot-like behavior
        $suspiciousPatterns = [
            'bot', 'crawler', 'spider', 'scraper', 'curl', 'wget', 'python', 'java'
        ];

        foreach ($suspiciousPatterns as $pattern) {
            if (stripos($userAgent, $pattern) !== false) {
                Cache::put('suspicious_ip:' . $ip, true, 3600);
                Log::warning('Suspicious investment application attempt', [
                    'ip' => $ip,
                    'user_agent' => $userAgent,
                    'reason' => 'Bot-like user agent'
                ]);
                break;
            }
        }

        // Check for rapid form submissions (less than 30 seconds)
        $lastSubmissionKey = 'last_submission:' . $ip;
        $lastSubmission = Cache::get($lastSubmissionKey);

        if ($lastSubmission && (time() - $lastSubmission) < 30) {
            Cache::put('suspicious_ip:' . $ip, true, 3600);
            Log::warning('Suspicious investment application attempt', [
                'ip' => $ip,
                'reason' => 'Too fast submission'
            ]);
        }

        Cache::put($lastSubmissionKey, time(), 300); // 5 minutes

        // Check for honeypot fields
        if ($request->filled('website') || $request->filled('phone')) {
            Cache::put('suspicious_ip:' . $ip, true, 86400); // 24 hours
            Log::warning('Suspicious investment application attempt', [
                'ip' => $ip,
                'reason' => 'Honeypot field filled'
            ]);
        }
    }
}
