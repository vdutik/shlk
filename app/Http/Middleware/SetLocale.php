<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        // Отримуємо значення мови з параметра URL або використовуємо мову за замовчуванням.
        $locale = $request->get('locale') ?: $request->segment(1)?:LaravelLocalization::getDefaultLocale();
        // Встановлюємо мову додатку.
        if (array_key_exists($locale, LaravelLocalization::getSupportedLocales())) {
            App::setLocale($locale);
        // Перевіряємо, чи в URL вказано дефолтне значення.
            if (LaravelLocalization::getDefaultLocale() === $request->segment(1)
            ) {
                $segments = $request->segments();
                array_shift($segments);
                return redirect()->to(implode('/', $segments));
            }else{
                if ($locale !== $request->segment(1) && $locale !== LaravelLocalization::getDefaultLocale()) {
                    $segments = $request->segments();
                    array_unshift($segments, $locale);
                    return redirect()->to(implode('/', $segments));
                }

            }
        }else{
            App::setLocale(LaravelLocalization::getDefaultLocale());
        }

        return $next($request);
    }
}