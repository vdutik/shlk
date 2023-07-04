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
            [__('general.main'), route('index'), 'menu-item'],
            [__('general.about'), route('about'), 'menu-item'],
            [__('general.news'), route('news'), 'menu-item'],
            [__('general.public_info'), route('page','public_info'), 'menu-item'],
            [__('general.for_student'), route('news','for_student'), 'menu-item'],
            [__('general.admission'), route('news','admission'), 'menu-item'],
            [__('general.contact'), route('contact.index'), 'hover cat dropdown-item', [
                [__('general.online_admmision'),'https://cabinet.edbo.gov.ua/login/register','hover-dropdown-item'],
//                [__('general.ofline_admmision'),route('admission'),'hover-dropdown-item'],
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
