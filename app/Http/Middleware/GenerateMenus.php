<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Psr7\DroppingStream;

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
            $menu->admission->attr(['class'=>'hover cat dropdown-item']);

            $menu->item('admission')->add("Онлайн вступ",'https://vstup.edbo.gov.ua')->nickname('drop1');
            $menu->drop1->attr(['class'=> 'hover-dropdown-item']);

            $menu->item('admission')->add("Оффлайн вступ",'admission')->nickname('drop2');
            $menu->drop2->attr(['class'=> 'hover-dropdown-item']);
        });

        return $next($request);
    }
}
