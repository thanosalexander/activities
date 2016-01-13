<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('activities_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->text('description')->default('');
            $table->string('label');
            $table->timestamps();
        });

        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id');
            $table->integer('user_id')->nullable();
            $table->longText('content')->default('');
            $table->string('ip')->default('');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('activities_types');
        Schema::dropIfExists('activities');
    }
}
