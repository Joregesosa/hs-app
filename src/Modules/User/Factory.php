<?php

namespace App\Modules\User;

use Faker\Factory as FakerFactory;

class Factory
{
    public static function create($count = 5)
    {
        $faker = FakerFactory::create();
        $users = [];
        for ($i = 0; $i < $count; $i++) {
            $users[] = [
                'f_name' => $faker->firstName(),
                'm_name' => $faker->firstName(),
                'f_lastname' => $faker->lastName(),
                's_lastname' => $faker->lastName(),
                'email' => $faker->email(),
                'role_id' => $faker->numberBetween(1, 4),
                'password' => password_hash(123456, PASSWORD_DEFAULT),
            ];
        }
        return $users;
    }
}
