<?php

namespace Project\App\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use Project\App\Application\JwtManager;
use Project\App\Models\User;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ServerRequestInterface;

class AuthController
{
    private ClientInterface $client;
    private const AUTH_URI = 'https://postman-echo.com/basic-auth';
    private JwtManager $jwtManager;

    public function __construct(JwtManager $jwtManager , ClientInterface $client)
    {
        $this->client = $client;
        $this->jwtManager = $jwtManager;
    }

    public function index(ServerRequestInterface $request)
    {
        $credentials = $request->getParsedBody();
        $user = User::firstWhere('email', $credentials['email']);

        if (password_verify($credentials['password'], $user->password)) {
            return $this->jwtManager->createToken($user);
        }

        return [
            'success' => false,
        ];

    }

    public function logout()
    {
        return [
            'success' => true,
        ];
    }

    /**
     * @throws GuzzleException
     */
    public function auth(ServerRequestInterface $request)
    {
        $token = $request->getHeaderLine('Authorization');
        $response = $this->client->request('GET', self::AUTH_URI, [
            'headers' => [
                'Authorization' => $token
            ]
        ]);

        return $response->getBody()->getContents();
    }
}
