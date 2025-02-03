<?php

namespace App\Modules\School;

use Faker\Factory as FakerFactory;

class Factory
{
    public static function create($count = 5)
    {
        $faker = FakerFactory::create();
        $shools = [];
        for ($i = 0; $i < $count; $i++) {
            $shools[] = [
                'name' => $faker->words(2, true),
            ];
        }
        return $shools;
    }
}
