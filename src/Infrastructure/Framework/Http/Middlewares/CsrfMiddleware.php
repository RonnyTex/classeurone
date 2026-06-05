<?php

namespace Ronos\Infrastructure\Framework\Http\Middlewares;

use Ronos\Infrastructure\Framework\Http\Foundation\HttpRequest;
use Ronos\Infrastructure\Framework\Http\Foundation\Response\ResponseInterface;
use Ronos\Infrastructure\Framework\Http\Foundation\Session\SessionInterface;
use Ronos\Infrastructure\Framework\Http\Foundation\Response\JsonResponse;

class CsrfMiddleware {

    public function __construct
    (
        private SessionInterface $session,
    )
    { }

    /**
     * Vérifie les token CSRF;
     */
    public function handle(HttpRequest $request): ?ResponseInterface
    {   

        if($request->getMethod() === 'POST'){

            if(!$request->getBody()['_csrf'] || !hash_equals($this->session->get('csrf.token'), $request->getBody()['_csrf'])){
                return new JsonResponse(['error' => "CSRF"], 403);
            }
            $token = $this->session->get('csrf.token');
            unset($token);
        }

        return null;
    }
}