<?php

namespace Project\App\Middlewares;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class AuthMiddleware
{
    private ResponseFactoryInterface $responseFactory;

    public function __construct(ResponseFactoryInterface $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }
    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $authToken = $request->getHeaderLine('Authorization');
        if ($authToken !== 'Bearer cG9zdG1hbjpwYXNzd29yZA==') {
            $response = $this->responseFactory->createResponse();
            $response->getBody()->write('Unauthorized');

            return $response->withStatus(401);
        }

        return $handler->handle($request);
    }
}