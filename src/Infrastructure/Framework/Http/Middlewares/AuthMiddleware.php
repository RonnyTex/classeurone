<?php

namespace Infrastructure\Framework\Http\Middlewares;

use Infrastructure\Framework\Http\Foundation\HttpRequest;
use Infrastructure\Framework\Http\Foundation\Response\ResponseInterface;
use Infrastructure\Framework\Http\Foundation\Response\RedirectResponse;
use Infrastructure\Framework\Http\Foundation\Response\JsonResponse;
use Infrastructure\Framework\Http\Foundation\Session\SessionInterface;
use Infrastructure\Framework\Http\Auth\AuthInterface;

class AuthMiddleware {

    public function __construct
    (
        private SessionInterface $session,
        private AuthInterface $auth,
        private string $loginUrl = '/'
    )
    {
        $this->loginUrl = $loginUrl;
    }

    /**
     * Vérifie si l'utilisateur est authentifié;
     */
    public function handle(HttpRequest $request, bool $redirect = true): ?ResponseInterface
    {
        $this->session->start();

        if(!$this->auth->isAuthenticated()){
            $this->session->destroy();

            if($redirect){
                return new RedirectResponse($this->loginUrl);
            } else {
                return new JsonResponse(['error' => 'Unauthenticated'],401);
            }
        }

        # Renouvelle l'expiration à chaque requete
        $this->auth->refreshExpiry(time() + $this->auth->getSessionLifetime());
        return null;
    }
}