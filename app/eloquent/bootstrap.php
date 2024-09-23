<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;
$env = parse_ini_file(__DIR__ . '/../../.env', true);

$capsule->addConnection([

    "driver" => $env['DB_DRIVER'],

    "host" => $env['DB_HOST'],

    "database" => $env['DB_DATABASE'],

    "username" => $env['DB_USERNAME'],

    "password" => $env['DB_PASSWORD'],

]);

//Make this Capsule instance available globally.
$capsule->setAsGlobal();

// Setup the Eloquent ORM.
$capsule->bootEloquent();
$capsule->bootEloquent();