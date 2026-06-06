<?php

namespace Interface\Http\Controllers\User;

use Infrastructure\Framework\Http\Controllers\AbstractController;
use Infrastructure\Framework\Http\Foundation\Session\SessionInterface;
use Application\Usecases\Admin\UpdateUserUsecase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class UpdateUserController extends AbstractController {

    public function __construct
    (
        private UpdateUserUsecase $uc,
        private SessionInterface $session
    ) { }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $userId = $request->getAttribute('id');
        $body = $request->getParsedBody();


        $output = $this->uc->execute($userId, $body);
   
        if(!$output->isSuccess()){
            var_dump($output);
            die('update user controller');
        }

        return $this->redirect('/app/accounts');
    }


}