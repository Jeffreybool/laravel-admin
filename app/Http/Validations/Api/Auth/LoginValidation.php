<?php
/**
 * Created by PhpStorm.
 * User: JeffreyBool
 * Date: 2018/8/27
 * Time: 00:15
 */

namespace App\Http\Validations\Api\Auth;

class LoginValidation
{
    public function login()
    {
        return [
            'rules' => [
                'username'     => 'required|string',
                'password'     => 'required|string',
            ],

            'messages' => [
                'username.required'     => '用户名不能为空',
                'username.string'       => '用户名必须是字符串',
                'password.required' => '密码不能为空',
                'password.string'   => '密码必须是字符串',
            ]
        ];
    }

    public function refresh()
    {
        return [
            'rules' => [
                'refresh_token'     => 'required|string',
            ],

            'messages' => [
                'refresh_token.required'     => 'refresh_token不能为空',
                'refresh_token.string'       => 'refresh_token必须是字符串',
            ]
        ];
    }
}