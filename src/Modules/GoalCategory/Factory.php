<?php

namespace App\Modules\GoalCategory;

use Faker\Factory as FakerFactory;

class Factory
{
    public static function create($count = 5)
    {
        $faker = FakerFactory::create();
        $categories = [
            [
                'name' => 'Epiritual',
            ],
            [
                'name' => 'Familiar',
            ],
            [
                'name' => 'Intelectual',
            ],
            [
                'name' => 'Laboral',
            ],
            [
                'name' => 'Fisico',
            ]

        ];

        return $categories;
    }
}
