<?php
/*/**
 * Created by PhpStorm.
 * User: JeffreyBool
 * Date: 2018/11/22
 * Time: 00:00
 */

namespace App\Http\Validations\Api\Front;

use Illuminate\Validation\Rule;

class CategoriesValidation
{
    public function store()
    {
        return [
            'rules' => [
                'name'        => 'required|string|between:2,10|unique:categories',
                'icon'        => 'nullable|string|max:30',
                'description' => 'nullable|max:200',
                'sort'        => 'nullable|integer',
            ],

            'messages' => [
                'name.required'   => '分类名称不能为空',
                'name.string'     => '分类名称必须是字符串',
                'name.between'    => '分类名称必须介于 2 - 10 个字符之间',
                'name.unique'     => '分类名称已经被占用了',
                'icon.string'     => 'icon必须是字符串',
                'icon.max'        => 'icon最大不能超过30个字符',
                'description.max' => '描述不能超过200个字符',
                'sort.integer'    => '排序必须为数字'
            ],
        ];
    }


    public function update()
    {
        return [
            'rules' => [
                'name'        => ['nullable','string','between:2,10', Rule::unique('categories')->ignore(request()->route('category.id'))],
                'icon'        => 'nullable|string|max:30',
                'description' => 'nullable|max:200',
                'sort'        => 'nullable|integer',
            ],

            'messages' => [
                'name.string'     => '分类名称必须是字符串',
                'name.between'    => '分类名称必须介于 2 - 10 个字符之间',
                'name.unique'     => '分类名称已经被占用了',
                'icon.string'     => 'icon必须是字符串',
                'icon.max'        => 'icon最大不能超过30个字符',
                'description.max' => '描述不能超过200个字符',
                'sort.integer'    => '排序必须为数字'
            ],
        ];
    }
}
