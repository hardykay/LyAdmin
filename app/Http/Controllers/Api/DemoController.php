<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Demo2;

class DemoController extends BaseController{

    public function demo()
    {
        return $this->response->array(['code'=>'200','msg'=>'success']);
    }

    public function demo2(Demo2 $request)
    {
        $request->input('uid','');

    }
}