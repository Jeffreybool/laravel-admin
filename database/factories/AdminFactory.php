<?php
/**
 * Created by PhpStorm.
 * User: JeffreyBool
 * Date: 2019/6/24
 * Time: 23:53
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

$factory->define(\App\Models\Admin::class, function(Faker $faker) {
    $date_time = $faker->date . ' ' . $faker->time;
    return [
        'name'       => "admin",
        'email'      => "admin@qq.com",
        'password'   => bcrypt("admin"), // secret
        'avatar'     => "https://dev-file.iviewui.com/YSlcnG8cnT6zMRGskMn4F5E0sghiFB9w/small",
        "role_id"    => 1,
        'created_at' => $date_time,
        'updated_at' => $date_time,
    ];
});
