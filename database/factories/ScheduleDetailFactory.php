<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Laravue\Models\ScheduleDetail;
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
$factory->define(ScheduleDetail::class, function (Faker $faker, $attrib) {
    return [
        'schedule_id' => $attrib['schedule_id'],
        'sub_id' => $attrib['sub_id'],
        'sub_name' => $attrib['sub_name'],
        'student_id' => $attrib['student_id'],
        'teacher_id' => $attrib['teacher_id'],
        'school_id' => $attrib['school_id'],
        'start_time' => $attrib['start_time'],
        'end_time' => $attrib['end_time'],
        'branch_id'=> 1,
        'status' => 1
    ];
});
