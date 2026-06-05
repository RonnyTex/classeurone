<?php

namespace Infrastructure\Framework\Http\Middlewares;

use Infrastructure\Framework\Http\Foundation\HttpRequest;
use Infrastructure\Framework\Http\Foundation\Response\ResponseInterface;
use Infrastructure\Framework\Http\Foundation\Response\RedirectResponse;

class TrailingSlashMiddleware {

    public function __construct()
    { }

    /**
     * Vérifie les / en fin d'url et redirige sans
     */
    public function handle(HttpRequest $request): ?ResponseInterface
    {   
        if($request->getUri() !== '/' && $request->getUri()[-1] === '/'){
            return new RedirectResponse(substr($request->getUri(), 0, -1));
        }
        return null;
    }
}