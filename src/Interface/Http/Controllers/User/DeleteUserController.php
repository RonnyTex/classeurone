<?php

namespace Interface\Http\Controllers\User;

use Infrastructure\Framework\Http\Controllers\AbstractController;
use Application\Usecases\Admin\DeleteUserUsecase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class DeleteUserController extends AbstractController {

    public function __construct
    (
        private DeleteUserUsecase $uc,
    )
    { }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $userId = $request->getAttribute('id');
     
        $output = $this->uc->execute($userId);
   
        if(!$output->isSuccess()){
            var_dump($output);
            die('delete user controller');
        }

        return $this->redirect('/app/accounts');
    }


}