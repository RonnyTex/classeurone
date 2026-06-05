<?php

namespace Ronos\Interface\Http\Controllers\Auth;

use Ronos\Infrastructure\Framework\Http\Controllers\AbstractController;
use Ronos\Infrastructure\Framework\Http\Foundation\HttpRequest;
use Ronos\Infrastructure\Framework\Http\Foundation\Response\ResponseInterface;
use Ronos\Infrastructure\Framework\Http\Error\ErrorMapper;
use Ronos\Application\Usecases\Auth\LogoutUserUsecase;

class LogoutUserController extends AbstractController {

    public function __construct(private LogoutUserUsecase $usecase)
    { }

    public function __invoke(HttpRequest $request): ResponseInterface
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