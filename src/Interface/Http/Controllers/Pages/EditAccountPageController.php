<?php

namespace Interface\Http\Controllers\Pages;

use Infrastructure\Framework\Http\Controllers\AbstractController;

use Application\Usecases\Admin\ShowUserUsecase;
use Domain\User\User;
use Psr\Http\Message\ServerRequestInterface;

class EditAccountPageController extends AbstractController {

    public function __construct(private ShowUserUsecase $uc)
    { }

    public function __invoke(ServerRequestInterface $request)
    {      
        $userId = $request->getAttribute('id');
        $user = $this->uc->execute($userId);

        if($user === null){
            return $this->notFound();
        }

        $form = $this->createForm(User::class, $user->getUuid(), [
            'ignore' => ['createdAt', 'updatedAt']
        ]);
        
        return $this->render('auth/accounts/account.edit', ['form' => $form]);
    }
}