<?php

namespace App\Modules\Category;

use Faker\Factory as FakerFactory;

class Factory
{
    public static function create($count = 5)
    {
        $faker = FakerFactory::create();
        $categories = [];
        for ($i = 0; $i < $count; $i++) {
            $categories[] = [
                'name' => $faker->colorName(),
                'description' => $faker->sentence(3),
            ];
        }
        return $categories;
    }
}
