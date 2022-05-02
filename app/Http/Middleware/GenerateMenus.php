<?php

namespace App\Http\Middleware;

use Closure;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //doca https://github.com/lavary/laravel-menu

        \Menu::make('MyNavBar', function ($menu) {
            $menu->add('Головна');
            $menu->add('Про нас', 'about');
            $menu->add('Новини', 'news');
            $menu->add('Зв\'язок', 'contact');
            $menu->add('Вступ', 'admission')->nickname('admission');

            $menu->admission->attr(['class'=>' cat collapsed navbar navbar-about dropdown  dropdown-toggle','data-toggle' => 'dropdown']);
            $menu->item('admission')->add("Онлайн вступ",'https://vstup.edbo.gov.ua');
            $menu->item('admission')->add("Оффлайн вступ",'admission');
        });

        return $next($request);
    }
}
