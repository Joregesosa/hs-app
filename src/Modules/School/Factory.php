<?php

namespace App\Modules\School;

use Faker\Factory as FakerFactory;

class Factory
{
    public static function create($count = 5)
    {
        $faker = FakerFactory::create();
        $shools = [
            ['name' => 'Software'],
            ['name' => 'Ingles'],
            ['name' => 'Matematicas'],
            ['name' => 'Redes'],
            ['name' => 'Marketing Digital'],
        ];
         
        return $shools;
    }
}
