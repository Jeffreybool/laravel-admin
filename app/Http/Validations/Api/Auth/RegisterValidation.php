<?php
/**
 * Created by PhpStorm.
 * User: JeffreyBool
 * Date: 2018/8/26
 * Time: 23:32
 */

namespace App\Http\Validations\Api\Auth;

use Illuminate\Support\Facades\Auth;

class RegisterValidation
{
    public function register()
    {
        return [
            'rules' => [
                'name'     => 'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,' . Auth::id(),
                'email'    => 'email|required|unique:users,email,' . Auth::id(),
                'password' => 'required|confirmed|min:6',
            ],

            'messages' => [
                'name.required'      => '用户名不能为空',
                'name.between'       => '用户名必须介于 3 - 25 个字符之间。',
                'name.regex'         => '用户名只支持中英文、数字、横杆和下划线。',
                'name.unique'        => '用户名已被占用，请重新填写',
                'email.email'        => '邮箱格式不正确',
                'email.required'     => '邮箱不能为空',
                'email.unique'       => '邮箱已经被人使用',
                'password.required'  => '密码不能为空',
                'password.confirmed' => '两次密码不一致',
                'password.min'       => '密码长度不能小于6位',
            ],
        ];
    }
}