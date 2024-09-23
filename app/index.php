<?php

use Project\App\Application\Application;
use Project\App\Application\RouteConfig;
use Slim\Factory\AppFactory;


require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/eloquent/bootstrap.php';

$container = new DI\Container(include __DIR__ . DIRECTORY_SEPARATOR . 'di-config.php');
// Set container to create App with on AppFactory
AppFactory::setContainer($container);
$app = AppFactory::create();

// Parse json, form data and xml
$app->addBodyParsingMiddleware();
// Add Routing Middleware
$app->addRoutingMiddleware();

$app->addErrorMiddleware(true, true, true);

$routes = new RouteConfig(include __DIR__ . DIRECTORY_SEPARATOR . 'routes.php');

$application = new Application($app, $routes, $container);

$application->run();