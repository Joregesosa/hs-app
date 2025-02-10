<?php
 
namespace App\Modules\Student;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

class Migration
{
    public static function createTable()
    {

        Capsule::schema()->create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('controller_id');
            $table->unsignedBigInteger('recruiter_id');
            $table->unsignedBigInteger('country_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('controller_id')->references('id')->on('users');
            $table->foreign('recruiter_id')->references('id')->on('users');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->timestamps();
        });
    }

    public static function dropTable()
    {
        Capsule::schema()->dropIfExists('students');
    }
}
