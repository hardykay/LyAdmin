<?php

$api = app('Dingo\Api\Routing\Router');

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api->version('v1',['namespace'=>'App\Http\Controllers\Api','middleware' => 'api.throttle', 'limit' => 60, 'expires' => 1], function ($api) {
    $api->get('/','DemoController@demo');
    $api->get('demo2','DemoController@demo2');
});