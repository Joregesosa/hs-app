<?php

namespace App\Modules\Service;

use Faker\Factory as FakerFactory;

class Factory
{
    public static function create($count = 5)
    {
        $faker = FakerFactory::create();
        $services = [];
        for ($i = 0; $i < $count; $i++) {
            $services[] = [
                'amount_reported' => $faker->numberBetween(0, 15),
                'amount_approved' => $faker->numberBetween(0, 15),
                'evidence' => $faker->imageUrl(),
                'description' => $faker->text(200),
                'comment' => $faker->text(200),
                'status' => $faker->numberBetween(0, 1),
                'user_id' => $faker->numberBetween(1, 5),
                'reviewer_id' => $faker->numberBetween(1, 5),
                'category_id' => $faker->numberBetween(1, 5),
            ];
        }
        return $services;
    }
}
