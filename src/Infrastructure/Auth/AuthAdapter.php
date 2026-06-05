<?php

namespace Infrastructure\Auth;

use Domain\Auth\AuthInterface;
use Infrastructure\Framework\Http\Auth\SessionAuth;

class AuthAdapter implements AuthInterface {

    public function __construct(private SessionAuth $auth)
    { }

    public function login(string $userId): void
    {
        $this->auth->login($userId);
    }

    public function logout(): void
    {
        $this->auth->logout();
    }

    public function isAuthenticated(): bool
    {
        return $this->auth->isAuthenticated();
    }

    public function getUser(): ?string
    {
        return $this->auth->getUser();
    }

}