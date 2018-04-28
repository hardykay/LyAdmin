<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login','LoginController@login')->name('login'); //登录页
Route::post('dologin','LoginController@dologin')->name('dologin');  //登录
Route::delete('logout','LoginController@logout')->name('logout');   //登出


Route::group(['prefix'=>'admin','middleware'=>'auth:admin'],function (){

    Route::get('/', 'IndexController@index')->name('/'); //首页
    Route::get('404', 'IndexController@nopage')->name('404'); //不存在页面



    Route::get('users/list', 'UserController@list')->name('users.list'); //用户列表页




    Route::get('menus/list/{id?}', 'MenuController@list')->name('menus.list'); //栏目列表页
    Route::get('menus/add/page/{id?}', 'MenuController@addPage')->name('menus.add.page'); //栏目添加页
    Route::post('menus/add/do', 'MenuController@addDo')->name('menus.add.do'); //添加栏目
    Route::get('menus/edit/page/{id?}', 'MenuController@editPage')->name('menus.edit.page'); //栏目编辑页
    Route::patch('menus/edit/do', 'MenuController@editDo')->name('menus.edit.do'); //编辑栏目
    Route::delete('menus/del', 'MenuController@del')->name('menus.del'); //删除栏目


});