<?php 

namespace Infrastructure\Framework\Http\Auth;

use Infrastructure\Framework\Http\Foundation\Session\SessionInterface;
use Infrastructure\Framework\Http\Auth\AuthInterface;
use Infrastructure\Framework\Security\TokenGenerator;

class SessionAuth implements AuthInterface {

    private const SESSION_USER_KEY = 'auth_user_id';
    private const SESSION_TOKEN_KEY = 'auth_token';
    private const SESSION_EXPIRY_KEY = 'auth_expires_at';
    private const SESSION_LIFETIME = 7200;

    public function __construct(private SessionInterface $session)
    { }

    public function login(string $userid): void 
    {
        $this->session->start();
        $this->session->set(self::SESSION_USER_KEY, $userid);
        $this->session->set(self::SESSION_TOKEN_KEY, TokenGenerator::generate(32));
        $this->session->set(self::SESSION_EXPIRY_KEY, time() + self::SESSION_LIFETIME);
    }

    public function logout(): void
    {
        $this->session->start();
        $this->session->destroy();
    }

    public function isAuthenticated(): bool
    {
        if(
            empty($this->session->get(self::SESSION_USER_KEY)) ||
            empty($this->session->get(self::SESSION_TOKEN_KEY)) ||
            empty($this->session->get(self::SESSION_EXPIRY_KEY))
        ) {
            return false;
        }

        # Vérifie l'expiration
        if($this->session->get(self::SESSION_EXPIRY_KEY) < time()){
            return false;
        }

        return true;
    }

    public function refreshExpiry(int $lifetime): void
    {
        $this->session->set(self::SESSION_EXPIRY_KEY, $lifetime);
    }

    public function getUser(): ?string 
    {
        return $this->session->get(self::SESSION_USER_KEY);
    }

    public function getSessionLifetime(): int
    {
        return self::SESSION_LIFETIME;
    }
}