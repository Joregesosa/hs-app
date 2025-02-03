<?php

namespace App\Modules\SchoolUser;

use Faker\Factory as FakerFactory;

class Factory
{
    public static function create($count = 5)
    {
        $faker = FakerFactory::create();
        $schools_users = [];
        for ($i = 0; $i < $count; $i++) {
            $schools_users[] = [
                'user_id' => $faker->numberBetween(1, 5),
                'school_id' => $faker->numberBetween(1, 5),
            ];
        }
        return $schools_users;
    }
}
