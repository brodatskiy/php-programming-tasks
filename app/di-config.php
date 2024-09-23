<?php

use Project\App\Application\EnvConfig;
use Project\App\Application\JwtManager;
use Project\App\Application\MiddlewareService;
use Project\App\Components\Mailer;
use Project\App\Components\UserManager;
use Project\App\Controllers\AuthController;
use Project\App\Controllers\ProfileController;
use Project\App\Controllers\RegisterController;
use Project\App\Middlewares\AdminMiddleware;
use Psr\Container\ContainerInterface;
use Slim\Psr7\Factory\ResponseFactory;
use GuzzleHttp\Client;

return [
    'UserManager' => DI\autowire(UserManager::class)->constructor(DI\get('MailInterface')),
    'MailInterface' => DI\autowire(Mailer::class),
    'JwtManager' => DI\autowire(JwtManager::class)->constructor(DI\get('EnvConfig')),
    'EnvConfig' => DI\factory(function () {
        return new EnvConfig(parse_ini_file(__DIR__ . '/../.env', true));
    }),

    'MiddlewareService' => DI\autowire(MiddlewareService::class),
    'ResponseFactoryInterface' => DI\autowire(ResponseFactory::class),

    'Client' => new Client(),
    'ClientInterface' => DI\get('Client'),

    'AuthController' => DI\autowire(AuthController::class)->constructor(DI\get('JwtManager'), DI\get('ClientInterface')),
    'RegisterController' => DI\autowire(RegisterController::class)->constructor(DI\get('JwtManager')),
    'ProfileController' => DI\autowire(ProfileController::class),

    'AdminMiddleware' => function (ContainerInterface $c) {
        return new AdminMiddleware($c->get('ResponseFactoryInterface'), $c->get('JwtManager'));
    },
];