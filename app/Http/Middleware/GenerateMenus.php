<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Psr7\DroppingStream;
use Lavary\Menu;
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
        $menuData = self::getMenuData();
        $menu = self::buildMenu('MyNavBar', $menuData);
        return $next($request);
    }

    public static function buildMenu($name, $data)
    {
        $menu = \Menu::make($name, function($menu) use ($data) {
            foreach ($data as $item) {
                if (isset($item[3])) {
                    $menuItem = $menu->add($item[0], $item[1])->attr(['class' => $item[2]]);
                    foreach ($item[3] as $subitem) {
                        if (isset($subitem[3])) {
                            $submenuItem = $menuItem->add($subitem[0], $subitem[1])->attr(['class' => $subitem[2]]);
                            foreach ($subitem[3] as $thirdItem) {
                                $submenuItem->add($thirdItem[0], $thirdItem[1])->attr(['class' => $thirdItem[2]]);
                            }
                        } else {
                            $menuItem->add($subitem[0], $subitem[1])->attr(['class' => $subitem[2]]);
                        }
                    }
                } else {
                    $menu->add($item[0], $item[1])->attr(['class' => $item[2]]);
                }
            }
        });

        return $menu;
    }
    public static function getMenuData()
    {
        return [
            ['Головна', route('index'), 'menu-item'],
            ['Про нас', 'about', 'menu-item'],
            ['Новини', 'news', 'menu-item'],
            ['Публічна інформація', 'page/public_info', 'menu-item'],
            ['Студенту', 'news/for_student', 'menu-item'],
            ['Абітурієнту', 'news/admission', 'menu-item'],
            ['Зв\'язок', 'contact', 'hover cat dropdown-item', [
                ['Онлайн вступ','https://vstup.edbo.gov.ua','hover-dropdown-item'],
                ['Оффлайн вступ','admission','hover-dropdown-item'],
//                ['Product 4', 'products/4', 'hover-dropdown-item', [
//                    ['Product 4-1', 'products/4/1', 'third-dropdown-item'],
//                    ['Product 4-2', 'products/4/2', 'third-dropdown-item'],
//                    ['Product 4-3', 'products/4/3', 'third-dropdown-item']
//                        ]
//                    ]
                ]
            ]
        ];
    }


}
