<?php

namespace Project\App\Middlewares;

use Project\App\Application\JwtManager;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use UnexpectedValueException;

class AdminMiddleware
{
    private ResponseFactoryInterface $responseFactory;
    private JwtManager $jwtManager;

    public function __construct(ResponseFactoryInterface $responseFactory, JwtManager $jwtManager)
    {
        $this->responseFactory = $responseFactory;
        $this->jwtManager = $jwtManager;
    }

    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $token = $request->getHeaderLine('Authorization');
        $token = str_replace('Bearer ', '', $token);

        try {
            $decoded = $this->jwtManager->decode($token);
        } catch (UnexpectedValueException $e) {
            return $this->createUnauthorizedResponse();
        }

        if (!$decoded->admin) {
            return $this->createUnauthorizedResponse();
        }

        return $handler->handle($request);
    }

    private function createUnauthorizedResponse(): Response
    {
        $response = $this->responseFactory->createResponse();
        $response->getBody()->write('Unauthorized');

        return $response->withStatus(401);
    }
}