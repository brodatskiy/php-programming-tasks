<?php

require __DIR__ . "/../../index.php";

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('user_role', function ($table) {

    $table->increments('id');

    $table->integer('user_id')->unsigned();
    $table->integer('role_id')->unsigned();

    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');

    $table->timestamps();

});