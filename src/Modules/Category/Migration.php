<?php
// user migragtion file
namespace App\Modules\Category;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

class Migration
{
    public static function createTable()
    {
        Capsule::schema()->create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description');
            $table->timestamps();
        });
    }

    public static function dropTable()
    {
        Capsule::schema()->dropIfExists('categories');
    }
}
