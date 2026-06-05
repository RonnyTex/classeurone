<?php

namespace Infrastructure\Framework\Container;

interface ContainerInterface {

    /**
     * Enregistre un service
     */
    public function set(string $id, callable | string $concrete): void;

    /**
     * Return un service
     */
    public function get(string $id): mixed;

}