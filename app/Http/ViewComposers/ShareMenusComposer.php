<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Menu;
use Illuminate\Support\Facades\Route;

class ShareMenusComposer
{
    /**
     * @var
     */
    protected $share_menus;

    /**
     * ShareMenusComposer constructor.
     */
    public function __construct()
    {
        $request_route=Route::currentRouteName();
        $model_menu=new Menu();
        $menus=$model_menu->getSons(0);
        foreach ($menus as $index => $menu) {
            if(!empty($menu->href) && !Route::has($menu->href)){
                $menus[$index]->href='404';
            }
            $sons=$model_menu->getDoSons($menu->id);
            foreach ($sons as $s => $son) {
                if(!empty($son->href) && !Route::has($son->href)){
                    $sons[$s]->href='404';
                }
            }
            $menus[$index]->sons=$sons;
        }
        foreach ($menus as $index => $menu) {
            $menu_hrefs=[];
            $sons=$menu->sons;
            if($sons->count()==0 && $request_route==$menu->href){
                $menus[$index]->class='layui-this';
            }
            if($sons->count()>0){
                $sons_hrefs=array_unique(array_filter(array_pluck($sons,'href')));
                $menu_hrefs=array_unique(array_filter(array_merge($menu_hrefs,$sons_hrefs)));
                foreach ($sons as $s => $son) {
                    $son_hrefs=[$son->href];
                    $dos=$model_menu->getDoSons($son->id);
                    $do_hrefs=array_unique(array_filter(array_pluck($dos,'href')));
                    foreach ($do_hrefs as $do_href) {
                        $menu_hrefs=array_unique(array_filter(array_merge($menu_hrefs,explode(',',$do_href))));
                        $son_hrefs=array_unique(array_filter(array_merge($son_hrefs,explode(',',$do_href))));
                    }
                    if(in_array($request_route,$son_hrefs)){
                        $sons[$s]->class='layui-this';
                    }
                }
                if(in_array($request_route,$menu_hrefs)){
                    $menus[$index]->class='layui-nav-itemed';
                }
            }
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