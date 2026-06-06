<?php

namespace Interface\Http\Controllers\Auth;

use Infrastructure\Framework\Http\Controllers\AbstractController;
use Infrastructure\Framework\Http\Error\ErrorMapper;
use Application\Usecases\Auth\LogoutUserUsecase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LogoutUserController extends AbstractController {

    public function __construct(private LogoutUserUsecase $usecase)
    { }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
  
        $output = $this->usecase->execute();
        
        if(!$output->isSuccess()){
            $status = ErrorMapper::map($output->getErrorType());
            
            return $this->render('app.php', [
                'errors' => $output->getErrors()
            ], $status);
        }
        
        return $this->redirect('/');
    }
}