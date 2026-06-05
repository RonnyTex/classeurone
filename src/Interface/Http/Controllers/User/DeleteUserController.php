<?php

namespace Interface\Http\Controllers\User;

use Infrastructure\Framework\Http\Controllers\AbstractController;
use Infrastructure\Framework\Http\Foundation\HttpRequest;
use Infrastructure\Framework\Http\Foundation\Response\ResponseInterface;
use Infrastructure\Framework\Http\Foundation\Session\SessionInterface;
use Infrastructure\Framework\Http\Foundation\Response\HtmlResponse;
use Application\Usecases\Admin\DeleteUserUsecase;

class DeleteUserController extends AbstractController {

    public function __construct
    (
        private DeleteUserUsecase $uc,
    )
    { }

    public function __invoke(HttpRequest $request): ResponseInterface
    {
        $userId = $request->getParams()['id'];
     
        $output = $this->uc->execute($userId);
   
        if(!$output->isSuccess()){
            var_dump($output);
            die('delete user controller');
        }

        return $this->redirect('/app/accounts');
    }


}