<?php
/**
 * Created by PhpStorm.
 * User: JeffreyBool
 * Date: 2019/4/3
 * Time: 14:39
 */

namespace App\Http\Validations\Api\Admin;


class TagsValidation
{
    public function store()
    {
        return [
            'rules' => [
                'name'            => 'required|between:3,25|unique:tags,name,' . request()->route('tag.id'),
                'img'          => 'nullable|mimes:jpeg,bmp,png,gif|dimensions:min_width=50,min_height=50',

            ],

            'messages' => [
                'name.required'      => '名称不能为空',
                'name.between'       => '名称必须介于 3 - 25 个字符之间。',
                'name.unique'        => '名称已被占用，请重新填写',
                'img.mimes'       => '头像格式不支持,目前只支持jpeg,bmp,png,gif格式',
                'img.dimensions'  => '头像的清晰度不够，宽和高需要 50px 以上',
            ]
        ];
    }
}