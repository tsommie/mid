<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Organization;
use Faker\Generator as Faker;

$factory->define(Organization::class, function (Faker $faker) {
    return [
        'name'                      => $faker->company,
        'email'                     => $faker->unique()->safeEmail,
        'description'               => $faker->text(400),
        'phone_number'              => $faker->phoneNumber,
        'website'                   => $faker->domainName,
        'user_id'                   => 1
    ];
});

$factory->afterCreating(App\Organization::class, function ($organization, $faker) {
    $organization->address()->save(factory(App\Address::class)->make());
});
