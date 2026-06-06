<?php

namespace Interface\Http\Controllers\User;

use Application\Usecases\User\CreateRoleUsecase;
use Infrastructure\Framework\Http\Controllers\AbstractController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CreateRoleController extends AbstractController {

    public function __construct(private CreateRoleUsecase $usecase)
    { }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getParsedBody();

        $this->usecase->execute($body['name']);
        
        return $this->redirect('/role/add');
    }
}