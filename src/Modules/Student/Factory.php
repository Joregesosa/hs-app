<?php

namespace App\Modules\Student;

use Faker\Factory as FakerFactory;

class Factory
{
    public static function create($count = 5)
    {
        $faker = FakerFactory::create();
        $students = [];
        for ($i = 0; $i < $count; $i++) {
            $students[] = [
                'user_id' => $faker->numberBetween(1, 5),
                'controller_id' => $faker->numberBetween(1, 5),
                'recruiter_id' => $faker->numberBetween(1, 5),
                'country_id' => $faker->numberBetween(1, 5),
            ];
        }
        return $students;
    }
}
