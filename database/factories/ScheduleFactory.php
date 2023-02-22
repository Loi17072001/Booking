<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Laravue\Models\Schedule;
use Carbon\Carbon;
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
$factory->define(Schedule::class, function (Faker $faker, $attrib) {
    $start_date = $faker->dateTimeBetween('+0 days', '+1 month');
    $start_date_clone = clone $start_date;

    $end_date = $start_date_clone->modify('+1 hours');
    return [
        'start_time' => $start_date,
        'end_time' => $end_date,
        'room_id' => $attrib['room_id'],
        'teacher_id' => $attrib['teacher_id'],
        'sub_id' => $attrib['sub_id'],
        'sub_name' => $attrib['sub_name'],
        'school_id' => $attrib['school_id'],
        'branch_id'=> 1,
        'status' => 1
    ];
});
