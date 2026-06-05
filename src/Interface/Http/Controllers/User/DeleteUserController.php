<?php

namespace Ronos\Interface\Http\Controllers\User;

use Ronos\Infrastructure\Framework\Http\Controllers\AbstractController;
use Ronos\Infrastructure\Framework\Http\Foundation\HttpRequest;
use Ronos\Infrastructure\Framework\Http\Foundation\Response\ResponseInterface;
use Ronos\Infrastructure\Framework\Http\Foundation\Session\SessionInterface;
use Ronos\Infrastructure\Framework\Http\Foundation\Response\HtmlResponse;
use Ronos\Application\Usecases\Admin\DeleteUserUsecase;

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