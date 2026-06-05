<?php

namespace Interface\Http\Controllers\Pages;

use Infrastructure\Framework\Http\Controllers\AbstractController;
use Application\Usecases\Admin\ShowAllUsersUsecase;

class AccountsPageController extends AbstractController {

    public function __construct(private ShowAllUsersUsecase $uc)
    {

    }

    public function __invoke()
    {   
        
        $users = $this->uc->execute();
        return $this->render('auth/accounts/accounts', ['users' => $users]);
    }
}