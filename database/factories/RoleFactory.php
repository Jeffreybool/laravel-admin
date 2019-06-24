<?php
/**
 * Created by PhpStorm.
 * User: JeffreyBool
 * Date: 2019/6/25
 * Time: 00:10
 */

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(\App\Models\Role::class, function(Faker $faker) {
    $date_time = $faker->date . ' ' . $faker->time;
    return [
        'id'         => 1,
        'name'       => "超级管理员",
        'remark'     => '超级管理员,拥有所以权限',
        'created_at' => $date_time,
        'updated_at' => $date_time,
    ];
});
