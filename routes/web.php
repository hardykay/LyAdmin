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



    Route::get('menus/list/{id?}', 'MenuController@list')->name('menus/list'); //栏目列表页
    Route::get('menus/add', 'MenuController@add')->name('menus/add'); //栏目添加页
    Route::delete('menus/del/{id?}', 'MenuController@del')->name('menus/del'); //删除栏目


});