<?php

namespace Interface\Http\Controllers\School;

use Application\Usecases\School\CreateTypeUsecase;
use Infrastructure\Framework\Http\Controllers\AbstractController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CreateTypeController extends AbstractController {

    public function __construct(private CreateTypeUsecase $usecase)
    { }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getParsedBody();

        $this->usecase->execute($body['name']);
        
        return $this->redirect('/school/type/add');
    }
}