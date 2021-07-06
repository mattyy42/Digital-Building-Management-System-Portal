<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Role;
use Faker\Generator as Faker;
use App\User;
$factory->define(Role::class, function (Faker $faker) {
    return [
        'name'=>$faker->name('applicant'),
        'user_id'=>factory(User::class)->create()->id,
    ];
});
