<?php
/**
 * Created by PhpStorm.
 * User: JeffreyBool
 * Date: 2018/8/29
 * Time: 00:02
 */

namespace App\Http\Validations\Api\Admin;

use Illuminate\Validation\Rule;

class PermissionValidation
{
    public function store()
    {
        return [
            'rules' => [
                'name'      => 'required|between:1,20|unique:permissions',
                'route'     => 'nullable|max:256',
                'parent_id' => 'nullable|integer',
                'is_hidden' => 'nullable|integer',
                'sort'      => 'nullable|integer',
                'status'    => 'nullable|integer',
            ],

            'messages' => [
                'name.required'     => '名称不能为空',
                'name.between'      => '名称长度必须为1到20位',
                'name.unique'       => '名称已经被使用',
                'route.max'         => '路由长度不能超过256个字符',
                'parent_id.integer' => '上级权限id必须为整型',
                'is_hidden.integer' => 'is_hidden必须为整型',
                'sort.integer'      => 'sort必须为整型',
                'status.integer'    => 'status必须为整型',
            ]
        ];
    }

    public function update()
    {
        return [
            'rules' => [
                'name'      => [
                    'nullable',
                    'between:1,20',
                    Rule::unique('permissions')->ignore(request()->route('permission.id'))
                ],
                'route'     => 'nullable|max:256',
                'parent_id' => 'nullable|integer',
                'is_hidden' => 'nullable|integer',
                'sort'      => 'nullable|integer',
                'status'    => 'nullable|integer',
            ],

            'messages' => [
                'name.between'      => '名称长度必须为1到20位',
                'name.unique'       => '名称已经被使用',
                'route.max'         => '路由长度不能超过256个字符',
                'parent_id.integer' => '上级权限id必须为整型',
                'is_hidden.integer' => 'is_hidden必须为整型',
                'sort.integer'      => 'sort必须为整型',
                'status.integer'    => 'status必须为整型',
            ]
        ];
    }
}