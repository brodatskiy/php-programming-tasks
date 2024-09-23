<?php

$env = parse_ini_file(__DIR__ . '/.env', true);

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/database/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/database/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'development' => [
            'adapter' => $env['DB_DRIVER'],
            'host' => $env['DB_HOSTNAME'],
            'name' => $env['DB_DATABASE'],
            'user' => $env['DB_USERNAME'],
            'pass' => $env['DB_PASSWORD'],
            'port' => $env['DB_PORT'],
            'charset' => 'utf8',
        ],
    ],
    'version_order' => 'creation'
];
