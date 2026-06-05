<?php

namespace Ronos\Application\DTO\Auth;

class LoginUserOutput {

    public function __construct
    (
        private bool $success,
        private ?\Throwable $errorType = null,
        private ?array $errors = [],
    )
    { }
    
    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getErrorType(): \Throwable 
    {
        return $this->errorType;
    }
}