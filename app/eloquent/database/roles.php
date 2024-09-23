<?php

require __DIR__ . "/../../index.php";

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('roles', function ($table) {

    $table->increments('id');
    $table->string('title');

    $table->timestamps();

});