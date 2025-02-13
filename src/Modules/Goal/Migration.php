<?php
// user migragtion file
namespace App\Modules\Goal;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

class Migration
{
    public static function createTable()
    {
        Capsule::schema()->create('goals', function (Blueprint $table) {
            $table->id();
            $table->string('goal');
            $table->year('year');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('subcategory_id')->references('id')->on('goal_subcategories'); 
            $table->timestamps();
        });
    }

    public static function dropTable()
    {
        Capsule::schema()->dropIfExists('goals');
    }
}
