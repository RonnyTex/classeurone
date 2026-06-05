<?php

namespace Infrastructure\Framework\View;

interface ViewInterface {

    public function render(string $view, array $data): string;

}