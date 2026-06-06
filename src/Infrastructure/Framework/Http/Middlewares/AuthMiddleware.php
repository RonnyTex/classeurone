<?php

namespace Infrastructure\Framework\Http\Middlewares;

use Infrastructure\Framework\Http\Foundation\Response\RedirectResponse;
use Infrastructure\Framework\Http\Foundation\Response\JsonResponse;
use Infrastructure\Framework\Http\Foundation\Session\SessionInterface;
use Infrastructure\Framework\Http\Auth\AuthInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthMiddleware implements MiddlewareInterface {

    public function __construct
    (
        private SessionInterface $session,
        private AuthInterface $auth,
        private string $loginUrl = '/',
        private bool $redirect = false
    )
    {
        $this->loginUrl = $loginUrl;
    }

    /**
     * Vérifie si l'utilisateur est authentifié;
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $this->session->start();

        if(!$this->auth->isAuthenticated()){
            $this->session->destroy();

            if($this->redirect){
                return new RedirectResponse($this->loginUrl);
            } else {
                return new JsonResponse(['error' => 'Unauthenticated'],401);
            }
        }

        # Renouvelle l'expiration à chaque requete
        $this->auth->refreshExpiry(time() + $this->auth->getSessionLifetime());
        return $handler->handle($request);
    }
}