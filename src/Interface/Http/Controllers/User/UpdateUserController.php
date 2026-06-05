<?php

namespace Interface\Http\Controllers\User;

use Infrastructure\Framework\Http\Controllers\AbstractController;
use Infrastructure\Framework\Http\Foundation\HttpRequest;
use Infrastructure\Framework\Http\Foundation\Response\ResponseInterface;
use Infrastructure\Framework\Http\Foundation\Session\SessionInterface;
use Infrastructure\Framework\Http\Foundation\Response\HtmlResponse;
use Application\Usecases\Admin\UpdateUserUsecase;

class UpdateUserController extends AbstractController {

    public function __construct
    (
        private UpdateUserUsecase $uc,
        private SessionInterface $session
    ) { }

    public function __invoke(HttpRequest $request): ResponseInterface
    {
        $userId = $request->getParams()['id'];
        $body = $request->getBody();


        $output = $this->uc->execute($userId, $body);
   
        if(!$output->isSuccess()){
            var_dump($output);
            die('update user controller');
        }

        return $this->redirect('/app/accounts');
    }


}