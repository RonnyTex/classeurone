<?php

namespace Ronos\Infrastructure\Framework\Config;

class Config {

    private array $settings;

    public function __construct(array $settings)
    {
        $this->settings = $settings;
    }

    public function get(string $key): mixed
    {
        if(!isset($this->settigs[$key])){
            throw new Exceptions("La clé $key n'existe pas dans la configuration.");
        }
       
        return $this->key;
    }

}