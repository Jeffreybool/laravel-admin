<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


$api = app('Dingo\Api\Routing\Router');


$api->version('v1', function($api) {
    $api->get("/",function(){
        return "hello word";
    });
});

foreach (glob(app()->basePath('routes/api/*/*.php')) as $filename) {
    include $filename;
}
