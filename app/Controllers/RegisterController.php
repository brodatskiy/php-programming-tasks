<?php

namespace Project\App\Controllers;

use Project\App\Application\JwtManager;
use Project\App\Models\Role;
use Project\App\Models\User;
use Psr\Http\Message\ServerRequestInterface;

class RegisterController
{
    private JwtManager $jwtManager;

    public function __construct(JwtManager $jwtManager)
    {
        $this->jwtManager = $jwtManager;
    }
    public function index(ServerRequestInterface $request)
    {
        $params = $request->getParsedBody();
        $params['password'] = password_hash($params['password'], PASSWORD_DEFAULT);
        $user = User::FirstOrCreate(['email' => $params['email']], $params);
        $roleAdmin = Role::FirstOrCreate(['title' => 'admin']);
        $user->roles()->attach($roleAdmin->id);

        return $this->jwtManager->createToken($user);
    }
}