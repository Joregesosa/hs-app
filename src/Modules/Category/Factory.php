<?php

namespace App\Modules\Category;

use Faker\Factory as FakerFactory;

class Factory
{
    public static function create($count = 5)
    {
        $faker = FakerFactory::create();
        $categories = [
            [
                'name' => 'Indexacion',
                'description' => 'Indexacion de nombre en family search',
            ],
            [
                'name' => 'Instructor',
                'description' => 'Instructor de la clase',
            ],
            [
                'name' => 'Liderazgo',
                'description' => 'Servir en el obispado o en la presidencia de la estaca',
            ],
            [
                'name' => 'Revision',
                'description' => 'Revision de registros en family search',
            ],
            [
                'name' => 'Asistencia al templo',
                'description' => 'Asistir al templo y llevar tus propias ordenanzas',
            ]

        ];

        return $categories;
    }
}
