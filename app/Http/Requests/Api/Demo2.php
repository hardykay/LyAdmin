<?php

namespace App\Http\Requests\Api;

use Dingo\Api\Http\FormRequest;

class Demo2 extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'uid'=>'required',
            'nickname'=>'required',
            'avatar'=>'required|url'
        ];
    }

    public function attributes()
    {
        return [
            'uid'=>'用户名id',
            'nickname'=>'昵称',
            'avatar'=>'头像'
        ];
    }
}
