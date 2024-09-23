<?php

namespace Project\App\Application;

use Psr\Container\ContainerInterface;
use Slim\App;

class Application
{
    private App $app;
    private RouteConfig $routes;
    private ContainerInterface $container;

    public function __construct($app, $routes, $container)
    {
        $this->app = $app;
        $this->routes = $routes;
        $this->container = $container;
    }

    public function run(): void
    {
        $routeService = new RouteService($this->app, $this->routes, $this->container);
        $routeService->handleRequest();
        $this->app->run();
    }
}