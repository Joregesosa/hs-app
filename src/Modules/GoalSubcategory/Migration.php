<?php

namespace App\Modules\GoalSubcategory;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

class Migration
{
    public static function createTable()
    {
        Capsule::schema()->create('goal_subcategories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->unsignedBigInteger('goal_category_id');
            $table->foreign('goal_category_id')->references('id')->on('goal_categories');
            $table->timestamps();
        });
    }

    public static function dropTable()
    {
        Capsule::schema()->dropIfExists('goal_subcategories');
    }
}
