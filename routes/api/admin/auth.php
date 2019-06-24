<?php
/**
 * Created by PhpStorm.
 * User: JeffreyBool
 * Date: 2018/11/5
 * Time: 00:15
 */

$api->version('v1', [
    'prefix' => 'admin',
    'namespace'  => 'App\Http\Controllers\Api\Admin',
    'middleware' =>[
        'cors',
        'api.throttle',
        'serializer:array'
    ],
], function($api) {
    //登录
    $api->post('auth/login', 'AuthorizationController@login')
        ->name('auth.login');

    // 根据refresh_token 换取access_token
    $api->post('auth/refresh', 'AuthorizationController@refresh')
        ->name('auth.refresh');

    //删除 token.
    $api->delete('auth/logout', 'AuthorizationController@logout')
        ->name('auth.logout');

    //个人信息
    $api->get('admin', 'AdminsController@info')
        ->name('admin')->middleware('auth:admin');

    // 当前登录用户权限
    $api->get('admin/permissions', 'AdminsController@permissions')
        ->name('admin.permissions')->middleware('auth:admin');
});