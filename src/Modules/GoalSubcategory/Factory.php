<?php

namespace App\Modules\GoalSubcategory;
 

class Factory
{
    public static function create($count = 5)
    {
        $categories = [
            [
                'name' => 'Proceso de Conversion',
                'goal_category_id' => 1
            ],
            [
                'name' => 'Ser un Discipulo',
                'goal_category_id' => 1
            ],
            [
                'name' => 'Esposo(a)/Novio(a)',
                'goal_category_id' => 2
            ],
            [
                'name' => 'Padre/Madre',
                'goal_category_id' => 2
            ],
            [
                'name' => 'Hiijo(a)',
                'goal_category_id' => 2
            ],
            [
                'name' => 'Educacion Formal', 
                'goal_category_id' => 3
            ],
            [
                'name' => 'Autoeducacion',
                'goal_category_id' => 3
            ],
            [
                'name' => 'Empleado',
                'goal_category_id' => 4
            ],
            [
                'name' => 'Emprendimiento',
                'goal_category_id' => 4
            ],
            [
                'name' => 'Ejercicios',
                'goal_category_id' => 5
            ],
            [
                'name' => 'Hobbies',
                'goal_category_id' => 5
            ]


        ];

        return $categories;
    }
}
