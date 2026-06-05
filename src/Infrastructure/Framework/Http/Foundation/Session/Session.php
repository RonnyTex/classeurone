<?php

namespace Infrastructure\Framework\Http\Foundation\Session;

use Infrastructure\Framework\Http\Foundation\Session\SessionInterface;

class Session implements SessionInterface {

    public function start(): void
    {
         if(session_status() === PHP_SESSION_ACTIVE){
            return;
        }

        session_set_cookie_params([
            'lifetime' => 0, # Cookie de session delete à la fermeture du navigateur
            'path' => '/',
            'domain' => '', # Domain courant
            'secure' => false, # Https uniquement
            'httponly' => true, # innacessible en javascript
            'samesite' => 'strict' # protection csrf
        ]);

        session_start();
        session_regenerate_id(true);
    }
    
    public function set(string $key, mixed $value): void
    {
        $this->start();
        $_SESSION[$key] = $value;
    }

    public function get(string $key, mixed $default = null): mixed
    {
        $this->start();
        return $_SESSION[$key] ?? $default;
    }

    public function has(string $key): bool
    {
        $this->start();
        return isset($_SESSION[$key]);
    }

    public function remove(string $key): void
    {
        $this->start();
        unset($_SESSION[$key]);
    }

    public function destroy(): void
    {
        $_SESSION = [];
        if(ini_get('session.use_cookies')){
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']

            );
        }
    }

   
}