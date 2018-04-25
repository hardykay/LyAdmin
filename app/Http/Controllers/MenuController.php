<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Requests\DelTest;

class MenuController extends Controller
{
    public function list($id='')
    {
        $model_menu=new Menu();
        $top_menus=$model_menu->getSons(0);
        if(empty($id)){
            $id=$top_menus[0]->id;
        }
        $son_menus=$model_menu->getSons($id);
        foreach ($son_menus as $index => $son_menu) {
            $sons=$model_menu->getSons($son_menu->id);
            $sons=array_pluck($sons,'title');
            $son_menus[$index]->sons=implode('、',$sons);
        }
        return view('menus.list',compact('id','top_menus','son_menus'));
    }

    /**
     * 栏目添加页
     * @param string $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function add_page($id='')
    {
        $model_menu=new Menu();
        $top_menus=$model_menu->getSons(0);
        $title='添加栏目';
        $menu=null;
        if(!empty($id)){
            $title='添加子操作';
            $menu=$model_menu->find($id);
            if(empty($menu)){
                return back();
            }
        }
        return view('menus.add',compact('id','title','menu','top_menus'));
    }

    /**
     * 添加栏目
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add_do(Request $request)
    {
        $title=$request->input('title','');
        $parent_id=$request->input('parent_id','0');
        $href=$request->input('href','');
        $sort=$request->input('sort','1000');
        if(empty($title)){
            return back()->with(compact('title','href','sort'));
        }
        $model_menu=new Menu();
        $re=$model_menu->addData(['title'=>$title,'parent_id'=>$parent_id,'href'=>$href,'sort'=>$sort]);
        if($re){
            return redirect()->route('menus/list');
        }else{
            return back()->with(compact('title','href','sort'));
        }
    }

    public function del($id='')
    {
        return response()->json(['as']);
    }

}