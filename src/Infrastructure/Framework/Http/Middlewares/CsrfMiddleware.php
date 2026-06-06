<?php

namespace Infrastructure\Framework\Http\Middlewares;

use Infrastructure\Framework\Http\Foundation\Session\SessionInterface;
use Infrastructure\Framework\Http\Foundation\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CsrfMiddleware implements MiddlewareInterface {

    public function __construct
    (
        private SessionInterface $session,
    )
    { }

    /**
     * Vérifie les token CSRF;
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {   

        if($request->getMethod() === 'POST'){

            if(!$request->getParsedBody()['_csrf'] || !hash_equals($this->session->get('csrf.token'), $request->getParsedBody()['_csrf'])){
                return new JsonResponse(['error' => "CSRF"], 403);
            }
            $token = $this->session->get('csrf.token');
            unset($token);
        }

        return $handler->handle($request);
    }
}