<?php

namespace Interface\Http\Controllers\User;

use Infrastructure\Framework\Http\Controllers\AbstractController;
use Infrastructure\Framework\Http\Error\ErrorMapper;
use Application\Usecases\User\CreateUserUsecase;
use Application\DTO\User\CreateUserInput;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CreateUserController extends AbstractController {

    public function __construct(private CreateUserUsecase $usecase)
    { }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getParsedBody();

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