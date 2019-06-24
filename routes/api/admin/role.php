<?php
/**
 * Created by PhpStorm.
 * User: JeffreyBool
 * Date: 2018/8/28
 * Time: 13:11
 */

$api->version('v1', [
    'prefix' => 'admin',
    'namespace' => 'App\Http\Controllers\Api\Admin',
    'middleware' => [
        'cors',
        'bindings',
        'auth:admin',
        'rbac',
        'serializer:array'
    ],
], function ($api) {

    //角色列表 (分页)
    $api->get('roles','RoleController@index')
        ->name('roles');

    //角色列表
    $api->get('roles/list','RoleController@list')
        ->name('roles.list');

    //新建角色.
    $api->post('roles','RoleController@store')
        ->name('roles.create');

    //查看角色
    $api->get('roles/{role}','RoleController@show')
        ->name('roles.show');

    //编辑角色
    $api->patch('roles/{role}','RoleController@update')
        ->name('roles.update');

    //删除角色
    $api->delete('roles/{role}','RoleController@delete')
        ->name('roles.delete');
});