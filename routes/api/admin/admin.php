<?php
/**
 * Created by PhpStorm.
 * User: JeffreyBool
 * Date: 2018/8/26
 * Time: 23:42
 */

$api->version('v1', [
    'prefix' => 'admin',
    'namespace'  => 'App\Http\Controllers\Api\Admin',
    'middleware' => [
        'cors',
        'bindings',
        'auth:admin',
        'rbac',
        'serializer:array'
    ],
], function($api) {

    //获取所有管理员
    $api->get('admins', 'AdminsController@index')
        ->name('admins');

    //新增
    $api->post('admins', 'AdminsController@store')
        ->name('admins.create');

    //查看
    $api->get('admins/{admin}', 'AdminsController@show')
        ->name('admins.show');

    //编辑
    $api->put('admins/{admin}', 'AdminsController@update')
        ->name('admins.update');

    //删除
    $api->delete('admins/{admin}', 'AdminsController@destroy')
        ->name('admins.delete');
});