<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get locale from session, URL parameter, or use default
        $locale = Session::get('locale');

        // If no locale in session, check if user has a preferred locale
        if (!$locale) {
            $locale = $request->getPreferredLanguage(['en', 'ar']) ?: config('app.locale');
        }

        // Ensure the locale is supported
        $supportedLocales = config('app.supported_locales', ['en', 'ar']);
        if (!in_array($locale, $supportedLocales)) {
            $locale = config('app.locale');
        }

        // Set the application locale
        App::setLocale($locale);

        return $next($request);
    }
}
