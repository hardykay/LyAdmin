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
        if(empty($id) || !$model_menu->find($id)){
            $id=$top_menus[0]->id;
            return redirect()->route('menus.list',['id'=>$id]);
        }
        $son_menus=$model_menu->getSons($id);
        foreach ($son_menus as $index => $son_menu) {
            $son_menus[$index]->sons=$model_menu->getSons($son_menu->id);
        }
        return view('menus.list',compact('id','top_menus','son_menus'));
    }

    /**
     * 栏目添加页
     * @param string $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function addPage($id='')
    {
        $model_menu=new Menu();
        $text='栏目';
        if(!empty($id)){
            $text='子操作';
            $menu=$model_menu->find($id);
            if(!$menu){
                return back();
            }
        }
        $top_menus=$model_menu->getSons(0);
        foreach ($top_menus as $index => $top_menu) {
            $top_menus[$index]->sons=$model_menu->getSons($top_menu->id);
        }
        return view('menus.add',compact('id','text','top_menus'));
    }

    /**
     * 添加栏目
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addDo(Request $request)
    {
        $title=$request->input('title','');
        $parent_id=$request->input('parent_id','0');
        $href=$request->input('href','');
        $sort=$request->input('sort','1000');
        if(empty($title)){
            return back();
        }
        $model_menu=new Menu();
        $re=$model_menu->addData(['title'=>$title,'parent_id'=>$parent_id,'href'=>$href,'sort'=>$sort]);
        if($re){
            return redirect()->route('menus.list');
        }else{
            return back();
        }
    }

    /**
     * 栏目编辑页
     * @param string $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function editPage($id='')
    {
        $model_menu=new Menu();
        if(empty($id)){
            return back();
        }
        $menu=$model_menu->find($id);
        if(!$menu){
            return back();
        }
        $top_menus=$model_menu->getSons(0);
        foreach ($top_menus as $index => $top_menu) {
            $top_menus[$index]->sons=$model_menu->getSons($top_menu->id);
        }
        return view('menus.edit',compact('id','menu','top_menus'));
    }

    /**
     * 编辑栏目
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editDo(Request $request)
    {
        $id=$request->input('id','');
        $title=$request->input('title','');
        $parent_id=$request->input('parent_id','0');
        $href=$request->input('href','');
        $sort=$request->input('sort','1000');
        if(empty($id) || empty($title)){
            return back();
        }
        $model_menu=new Menu();
        $re=$model_menu->upData($id,['title'=>$title,'parent_id'=>$parent_id,'href'=>$href,'sort'=>$sort]);
        if($re){
            return redirect()->route('menus.list');
        }else{
            return back();
        }
    }

    public function del(Request $request)
    {
        $id=$request->input('id','');
        return response()->json(['as']);
    }

}