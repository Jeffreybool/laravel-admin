<?php
/**
 * Created by PhpStorm.
 * User: JeffreyBool
 * Date: 2018/8/29
 * Time: 00:23
 */

$api->version('v1', [
    'prefix' => 'admin',
    'namespace' => 'App\Http\Controllers\Api\Admin',
    'middleware' => [
        'cors',
        'rbac',
        'auth:admin',
        'bindings',
        'serializer:array'
    ],
], function ($api) {

    //权限列表 (分页)
    $api->get('permissions','PermissionController@index')
        ->name('permissions');

    //权限列表
    $api->get('permissions/list','PermissionController@list')
        ->name('permissions.list');

    //新建权限.
    $api->post('permissions','PermissionController@store')
        ->name('permissions.create');

    //查看权限
    $api->get('permissions/{permission}','PermissionController@show')
        ->name('permissions.show');

    //更新权限
    $api->put('permissions/{permission}','PermissionController@update')
        ->name('permissions.update');

    //删除权限
    $api->delete('permissions/{permission}','PermissionController@delete')
        ->name('permissions.delete');
});