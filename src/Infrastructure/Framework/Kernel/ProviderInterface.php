<?php

namespace Infrastructure\Framework\Kernel;

use Infrastructure\Framework\Container\ContainerInterface;

interface ProviderInterface {

    // Permet d'enregistrer des services dans le container
    public function register(ContainerInterface $c);

    // Permet d'utiliser les services
    public function boot(ContainerInterface $c);

}