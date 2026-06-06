<?php

namespace Infrastructure\Framework\Env;

use Symfony\Component\Dotenv\Dotenv;

class Env {

    public function load()
    {
        $dotenv = new Dotenv();
        $dotenv->load(ROOT_PATH . '/.env');
    }


    public function get(string $key, ?string $default = null)
    {
        return $_ENV[$key] ?? $default;
    }


}