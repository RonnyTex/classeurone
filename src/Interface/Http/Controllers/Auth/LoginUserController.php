<?php

namespace Interface\Http\Controllers\Auth;

use Infrastructure\Framework\Http\Controllers\AbstractController;
use Infrastructure\Framework\Http\Foundation\HttpRequest;
use Infrastructure\Framework\Http\Foundation\Response\ResponseInterface;
use Infrastructure\Framework\Http\Error\ErrorMapper;
use Application\Usecases\Auth\LoginUserUsecase;

class LoginUserController extends AbstractController {

    public function __construct(private LoginUserUsecase $usecase)
    { }

    public function __invoke(HttpRequest $request): ResponseInterface
    {   
        $body = $request->getBody();
        $email = $body['email'];
        $password = $body['psw'];
       
        $output = $this->usecase->execute($email, $password);

        if(!$output->isSuccess()){
            $status = ErrorMapper::map($output->getErrorType());
        
            return $this->render('login', [
                'errors' => $output->getErrors()
            ], $status);
        }
        
        return $this->redirect('/app');
    }
}