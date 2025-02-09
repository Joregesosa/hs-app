<?php

namespace App\Modules\Role;

use Faker\Factory as FakerFactory;

class Factory
{
    public static function create($count = 5)
    {
        $faker = FakerFactory::create();
        $users = [
            [
                'name' => 'Admin',
            ],
            [
                'name' => 'Controller',
            ],
            [
                'name' => 'Recruiter',
            ],
            [
                'name' => 'Student',
            ]
        ];

        return $users;
    }
}
