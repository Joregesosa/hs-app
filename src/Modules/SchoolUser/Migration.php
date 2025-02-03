<?php
// user migragtion file
namespace App\Modules\SchoolUser;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

class Migration
{
    public static function createTable()
    {
        Capsule::schema()->create('school_user', function (Blueprint $table) {
            $table->unsignedBigInteger('school_id');
            $table->unsignedBigInteger('user_id');
            $table->primary(['school_id', 'user_id']);
        });
    }

    public static function dropTable()
    {
        Capsule::schema()->dropIfExists('school_user');
    }
}
