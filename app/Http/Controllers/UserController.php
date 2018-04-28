<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list(Request $request)
    {
        if($request->ajax()){
            $limit=$request->input('limit',10);
            $search=$request->input('search','');
            $orderField=$request->input('orderField','');
            $orderType=$request->input('orderType','');
            $model_user=new User();
            $users=$model_user->select('id','username','nickname','mobile','email','status')->when(!empty($search),function ($query) use ($search){
                return $query->where('username','like',"%$search%")->orWhere('nickname','like',"%$search%");
            })->when(!empty($orderField) && !empty($orderType),function ($query) use ($orderField,$orderType){
                return $query->orderBy($orderField,$orderType);
            })->paginate($limit);
            return response()->json(['code'=>'0','msg'=>'','count'=>$users->total(),'data'=>$users->items()]);
        }
        return view('users.list');
    }

    public function editDo(Request $request)
    {
        return response()->json(['code'=>'200']);
    }
}