<?php

namespace Infrastructure\Framework\Http\Auth;

interface AuthInterface {

    public function login(string $userId): void;

    public function logout(): void;

    public function isAuthenticated(): bool;

    public function getUser(): ?string;
}