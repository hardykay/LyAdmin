<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * 登录页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
        Auth::guard('admin')->logout();
        return view('login');
    }

    /**
     * 登录
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function dologin(Request $request)
    {
        $username=$request->input('username','');
        $password=$request->input('password','');
        if(empty($username) || empty($password)){
            return redirect()->back()->with('fail','请填写账号和密码！');
        }
        if (Auth::guard('admin')->attempt(['username' => $username, 'password' => $password],$request->has('remember'))) {
            if(Auth::guard('admin')->user()->status){
                return redirect()->route('/');
            }else{
                Auth::guard('admin')->logout();
                return redirect()->back()->with(['fail'=>'账号被禁用了！','username'=>$username]);
            }
        }else{
            return redirect()->back()->with(['fail'=>'账号或密码不正确！','username'=>$username]);
        }
    }

    /**
     * 登出
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login');
    }

}