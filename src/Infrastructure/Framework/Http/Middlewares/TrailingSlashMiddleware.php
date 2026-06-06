<?php

namespace Infrastructure\Framework\Http\Middlewares;

use Infrastructure\Framework\Http\Foundation\Response\RedirectResponse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class TrailingSlashMiddleware implements MiddlewareInterface {

    public function __construct()
    { }

    /**
     * Vérifie les / en fin d'url et redirige sans
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {   
        if($request->getUri()->getPath() !== '/' && $request->getUri()->getPath()[-1] === '/'){
            return new RedirectResponse(substr($request->getUri(), 0, -1));
        }
        return $handler->handle($request);
    }
}