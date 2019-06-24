<?php
/**
 * Created by PhpStorm.
 * User: JeffreyBool
 * Date: 2019/4/10
 * Time: 12:29
 */

$api->version('v1', [
    'prefix' => 'admin',
    'namespace'  => 'App\Http\Controllers\Api\Admin',
    'middleware' => [
        'cors',
        'api.throttle',
        'auth:admin',
        'rbac',
        'bindings',
        'serializer:array'
    ],
], function($api) {

    $api->post('files/upload', 'UploadsController@upload')
        ->name('files.upload');
});