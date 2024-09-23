<?php

namespace Project\App\Application;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use ReflectionClass;
use ReflectionException;
use Slim\App;

class RouteService
{
    private RouteConfig $routes;
    private App $app;
    private ContainerInterface $container;

    public function __construct($app, $routes, $container)
    {
        $this->app = $app;
        $this->routes = $routes;
        $this->container = $container;
    }

    public function handleRequest(): void
    {
        foreach ($this->routes->getConfig() as $route => $values) {
            $method = $values['method'];
            [$controllerName, $action] = explode("@", $values['action']);

            $middleware = $values['middleware'] ?? null;

            $middlewareService = $this->container->get('MiddlewareService');

            $this->app->map([...$method], $route . '[/{id}]', function (ServerRequestInterface $request, ResponseInterface $response, array $args) use ($controllerName, $action) {
                $controller = $this->get($controllerName);
                $id = $args['id'] ?? null;
                $data = $controller->$action($request, $response, $id);
                $message = new Message($data);
                $response->getBody()->write($message->getBody());

                return $response->withHeader('Content-Type', $message->getMessageType());
            })->add($middlewareService->create($middleware));
        }
    }
}