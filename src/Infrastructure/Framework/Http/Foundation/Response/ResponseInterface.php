<?php

namespace Ronos\Infrastructure\Framework\Http\Foundation\Response;

interface ResponseInterface {

    public function send(): void;

    public function getStatus(): int;

}