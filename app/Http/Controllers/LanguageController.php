<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * Switch the application language
     */
    public function switch(Request $request, $locale)
    {
        // Check if the locale is supported
        $supportedLocales = config('app.supported_locales', ['en', 'ar']);

        if (!in_array($locale, $supportedLocales)) {
            abort(404);
        }

        // Set the application locale
        App::setLocale($locale);

        // Store the locale in session
        Session::put('locale', $locale);

        // Redirect back to the previous page with language change flag
        return redirect()->back()->with('language_changed', true);
    }
}
