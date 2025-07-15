<?php

namespace App\Http\Middleware;

use App\Models\SiteSetting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MaintenanceMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if maintenance mode is enabled
        $maintenanceMode = SiteSetting::get('maintenance_mode', false);

        if ($maintenanceMode) {
            // Allow admin routes to pass through
            if ($request->is('admin/*') || $request->is('login') || $request->is('logout')) {
                return $next($request);
            }

            // Allow API routes for admin functionality
            if ($request->is('api/*')) {
                return $next($request);
            }

            // Redirect all other requests to maintenance page
            if (!$request->is('maintenance')) {
                return redirect()->route('maintenance');
            }
        }

        return $next($request);
    }
}
