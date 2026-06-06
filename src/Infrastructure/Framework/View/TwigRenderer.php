<?php

namespace Infrastructure\Framework\View;

use Infrastructure\Framework\Config\ConfigInterface;
use Infrastructure\Framework\Container\ContainerInterface;
use Infrastructure\Framework\View\ViewInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;


class TwigRenderer implements ViewInterface {

    
    private string $viewPath;
    private ConfigInterface $config;
    private FilesystemLoader $loader;
    private Environment $twig;


    public function __construct(private ContainerInterface $container, private bool $cache = false)
    {
        $this->container = $container;
        $this->config = $this->container->get(ConfigInterface::class);
        $this->viewPath = ROOT_PATH . $this->getViewPath();
        $this->loader = new FilesystemLoader($this->viewPath);
        $this->twig = new Environment($this->loader, [
            'cache' => $cache ? $this->getViewCache() : false,
        ]);
        
    }

    public function render(string $view, array $data): string
    {
 
        $template = $this->twig->load($view . '.html.twig');
        return $template->render($data);
    }


    public function getViewPath(): string
    {
        return $this->config->get('viewpath');
    }

    public function getViewCache(): bool|string
    {
        return $this->config->get('viewcahe');
    }

} 