<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Menu;
use Illuminate\Http\Request;

class ShareMenusComposer
{
    /**
     * @var
     */
    protected $share_menus;

    /**
     * ShareMenusComposer constructor.
     */
    public function __construct(Request $request)
    {
        $request_route=$request->route()->getName();
        $model_menu=new Menu();
        $menus=$model_menu->getSons(0);
        foreach ($menus as $index => $menu) {
            $sons=$model_menu->getSons($menu->id);
            $menus[$index]->sons=$sons;
        }
        $this->share_menus=$menus;
    }

    /**
     * 将数据绑定到视图。
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('share_menus', $this->share_menus);
    }
}