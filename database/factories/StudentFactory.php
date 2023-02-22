<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Laravue\Models\Student;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(Student::class, function (Faker $faker, $attrib) {
    return [
        'name' => $faker->name,
        'code' => 'HS-'.$faker->randomNumber(4, false),
        'identity_card' => $faker->randomNumber(9, false),
        'faculty' => $faker->randomElement(['CNTT', 'Mầm Non', 'Cầu Đường', 'Xây Dựng', 'Môi Trường', 'Hóa', 'Điện']),
        'phone' => $faker->unique()->tollFreePhoneNumber,
        'email' => $faker->unique()->safeEmail,
        'address'=> $faker->unique()->address,
        'dob' => $faker->date,
        'school_id' => $attrib['school_id'],
        'branch_id'=> 1,
        'status' => 1
    ];
});
