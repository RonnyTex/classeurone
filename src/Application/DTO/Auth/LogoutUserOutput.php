<?php

namespace Application\DTO\Auth;

class LogoutUserOutput {

    public function __construct
    (
        private bool $success,
        private ?\Throwable $errorType = null,
    )
    { }
    
    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function getErrorType(): \Throwable 
    {
        return $this->errorType;
    }
}