<?php

namespace Project\App\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ProfileController
{
    public function index(ServerRequestInterface $request, ResponseInterface $response, int $id)
    {
        return [
            'id' => $id,
            'name' => 'Tony',
            'gender' => 'male',
        ];
    }

}