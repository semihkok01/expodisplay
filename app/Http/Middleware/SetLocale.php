<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * @var array<int, string>
     */
    private array $supportedLocales = ['de', 'en', 'nl', 'fr', 'it'];

    public function handle(Request $request, Closure $next): Response
    {
        $requestedLocale = $request->query('lang');

        if (is_string($requestedLocale) && in_array($requestedLocale, $this->supportedLocales, true)) {
            $request->session()->put('locale', $requestedLocale);
        }

        $locale = $request->session()->get('locale', 'de');

        if (! in_array($locale, $this->supportedLocales, true)) {
            $locale = 'de';
            $request->session()->put('locale', $locale);
        }

        App::setLocale($locale);
        $request->setLocale($locale);

        return $next($request);
    }
}
