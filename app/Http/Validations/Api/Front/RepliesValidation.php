<?php
/**
 * Created by PhpStorm.
 * User: JeffreyBool
 * Date: 2019/4/3
 * Time: 22:02
 */

namespace App\Http\Validations\Api\Front;

class RepliesValidation
{
    public function store()
    {
        return [
            'rules' => [
                'content' => 'required|min:2',
            ],

            'messages' => [
                'content.required' => '回复内容不能为空',
                'content.string'   => '回复内容必须是字符串',
                'content.min'      => '回复内容不能少于2个字符',
            ],
        ];
    }
}