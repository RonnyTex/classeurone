<?php

namespace Infrastructure\Framework\Config;

use Symfony\Component\Yaml\Yaml;

class Config implements ConfigInterface {

    private array $settings;

    public function __construct(array $settings = [])
    {
        $this->settings = $settings;
    }

    public function get(string $key): mixed
    {
        if(!isset($this->settings[$key])){
            throw new \Exception("La clé $key n'existe pas dans la configuration.");
        }
       
        return $this->settings[$key];
    }


    public function load(): ?array
    {
        $configFiles = scandir(ROOT_PATH . '/config');

        $filtered = array_filter($configFiles, fn($path) => str_ends_with($path, '.yml'));

        foreach ($filtered as $file) {
            $config = Yaml::parseFile(ROOT_PATH . "/config/$file");
        }

        return $config;
    }

    public function setSettings(array $settings)
    {
        $this->settings = $settings;
    }

}