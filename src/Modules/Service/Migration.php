<?php

namespace App\Modules\Service;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

class Migration
{
    public static function createTable()
    {
        Capsule::schema()->create('services', function (Blueprint $table) {
            $table->id();
            $table->integer('amount_reported');
            $table->integer('amount_approved')->nullable();
            $table->string('evidence');
            $table->text('description')->nullable();
            $table->text('comment')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('reviewer_id')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('reviewer_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->timestamps();
        });
    }

    public static function dropTable()
    {
        Capsule::schema()->dropIfExists('services');
    }
}
