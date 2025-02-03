<?php
// user migragtion file
namespace App\Modules\School;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

class Migration
{
    public static function createTable()
    {
        Capsule::schema()->create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });
    }

    public static function dropTable()
    {
        Capsule::schema()->dropIfExists('schools');
    }
}
