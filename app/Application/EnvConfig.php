<?php

namespace Project\App\Application;

class EnvConfig
{
    private array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function getConfig(): array
    {
        return $this->config;
    }

    public function getSecretKey(){
        return $this->config['JWT_SECRET'];
    }

    public function getAppUrl(){
        return $this->config['APP_URL'];
    }
}