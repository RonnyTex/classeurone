<?php

namespace Ronos\Interface\Http\Controllers\User;

use Ronos\Infrastructure\Framework\Http\Controllers\AbstractController;
use Ronos\Infrastructure\Framework\Http\Foundation\HttpRequest;
use Ronos\Infrastructure\Framework\Http\Foundation\Response\ResponseInterface;
use Ronos\Infrastructure\Framework\Http\Error\ErrorMapper;
use Ronos\Application\Usecases\User\CreateUserUsecase;
use Ronos\Application\DTO\User\CreateUserInput;

class CreateUserController extends AbstractController {

    public function __construct(private CreateUserUsecase $usecase)
    { }

    public function __invoke(HttpRequest $request): ResponseInterface
    {
        $body = $request->getBody();

        $input = new CreateUserInput(
            $body['firstname'],
            $body['lastname'],
            $body['email'],
            $body['psw'],
            $body['pswConfirm']
        );
        
        $output = $this->usecase->execute($input);
 
        if(!$output->isSuccess()){

            $status = ErrorMapper::map($output->getErrorType());

            if($status === 500){
                var_dump($output->getErrors());
                die();
                return $this->redirect('/pages/500.html');
            }

            return $this->render('register', [
                'errors' => $output->getErrors()
            ], $status);
        }
        
        return $this->redirect('/app');
    }
}