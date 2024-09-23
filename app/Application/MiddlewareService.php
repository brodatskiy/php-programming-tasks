<?php

namespace Project\App\Application;

use Project\App\Middlewares\NextMiddleware;
use Psr\Container\ContainerInterface;
use Slim\Psr7\Factory\ResponseFactory;

class MiddlewareService
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {

        $this->container = $container;
    }

    public function create($middleware)
    {
        if ($middleware){
            return $this->container->get($middleware);
        }
        return new NextMiddleware();
    }
}