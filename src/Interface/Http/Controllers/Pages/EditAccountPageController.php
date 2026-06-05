<?php

namespace Interface\Http\Controllers\Pages;

use Infrastructure\Framework\Http\Controllers\AbstractController;
use Infrastructure\Framework\Http\Foundation\HttpRequest;
use Application\Usecases\Admin\ShowUserUsecase;
use Domain\User\User;

class EditAccountPageController extends AbstractController {

    public function __construct(private ShowUserUsecase $uc)
    { }

    public function __invoke(HttpRequest $request)
    {      
        $userId = $request->getParams()['id'];
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