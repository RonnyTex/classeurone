<?php

namespace Infrastructure\Framework\Config;

interface ConfigInterface {

    public function get(string $key): mixed;


    public function load(): ?array;
}