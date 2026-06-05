<?php


use Ronos\Interface\Http\Controllers\Pages\LandingPageController;
use Ronos\Interface\Http\Controllers\Pages\RegisterPageController;
use Ronos\Interface\Http\Controllers\User\CreateUserController;
use Ronos\Interface\Http\Controllers\Pages\LoginPageController;
use Ronos\Interface\Http\Controllers\Auth\LoginUserController;
use Ronos\Interface\Http\Controllers\Auth\LogoutUserController;
use Ronos\Interface\Http\Controllers\Pages\AppPageController;
use Ronos\Interface\Http\Controllers\Pages\AccountsPageController;
use Ronos\Interface\Http\Controllers\Pages\EditAccountPageController;
use Ronos\Interface\Http\Controllers\User\UpdateUserController;
use Ronos\Interface\Http\Controllers\User\DeleteUserController;


$router->get('/', [LandingPageController::class ], 'home');
$router->get('/login', [LoginPageController::class], 'login');
$router->post('/login', [LoginUserController::class ]);

$router->get('/nouvelle-ecole', [RegisterPageController::class ], 'register');
$router->post('/nouvelle-ecole', [CreateUserController::class ]);














$router->get('/logout', [LogoutUserController::class], 'logout');

$router->get('/app', [AppPageController::class ])->middleware('auth');

$router->get('/app/accounts', [AccountsPageController::class ])->middleware('auth');
$router->get('/app/accounts/:id', [EditAccountPageController::class ])->middleware('auth');
    
$router->post('/app/accounts/:id', [UpdateUserController::class ])->middleware('auth');
$router->get('/app/accounts/:id/delete', [DeleteUserController::class ])->middleware('auth');

