<?php

namespace Project\App\Application;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use stdClass;

class JwtManager
{
    private string $secretKey;
    private string $appUrl;

    public function __construct($envConfig)
    {
        $this->secretKey = $envConfig->getSecretKey();
        $this->appUrl = $envConfig->getAppUrl();
    }

    public function createToken($user): string
    {
        $payload = [
            'iss' => $this->appUrl,
            "email" => $user->email,
            "admin" => $user->isAdmin(),
            'iat' => time(),
        ];

        return JWT::encode($payload, $this->secretKey, 'HS256');
    }

    public function decode($token): stdClass
    {
        return JWT::decode($token, new Key($this->secretKey, 'HS256'));
    }

    public function getSecretKey(): string
    {
        return $this->secretKey;
    }
}