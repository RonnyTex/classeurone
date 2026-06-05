<?php

namespace Ronos\Interface\Http\Controllers\Auth;

use Ronos\Infrastructure\Framework\Http\Controllers\AbstractController;
use Ronos\Infrastructure\Framework\Http\Foundation\HttpRequest;
use Ronos\Infrastructure\Framework\Http\Foundation\Response\ResponseInterface;
use Ronos\Infrastructure\Framework\Http\Error\ErrorMapper;
use Ronos\Application\Usecases\Auth\LoginUserUsecase;

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