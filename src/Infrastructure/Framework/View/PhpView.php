<?php

namespace Ronos\Infrastructure\Framework\View;

use Ronos\Infrastructure\Framework\View\ViewInterface;

class PhpView implements ViewInterface {

    public function render(string $view, array $data = []): string
    {

        $viewpath = dirname(__DIR__, 4) . '/templates/' . $view . '.php';
        
        if(!file_exists($viewpath)){
            throw new \Exception("View $view does not exist.");
        }

        extract($data);

        ob_start();
        require $viewpath;
        $content = ob_get_clean();

        return $content;
    }
}