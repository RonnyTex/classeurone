<?php

use Interface\Http\Controllers\Pages\LandingPageController;
use Interface\Http\Controllers\Pages\RegisterPageController;
use Interface\Http\Controllers\User\CreateUserController;
use Interface\Http\Controllers\Pages\LoginPageController;
use Interface\Http\Controllers\Auth\LoginUserController;
use Interface\Http\Controllers\Auth\LogoutUserController;
use Interface\Http\Controllers\Pages\AppPageController;
use Interface\Http\Controllers\Pages\AccountsPageController;
use Interface\Http\Controllers\Pages\CreateRolePageController;
use Interface\Http\Controllers\Pages\CreateSchoolTypePageController;
use Interface\Http\Controllers\Pages\EditAccountPageController;
use Interface\Http\Controllers\School\CreateTypeController;
use Interface\Http\Controllers\User\CreateRoleController;
use Interface\Http\Controllers\User\UpdateUserController;
use Interface\Http\Controllers\User\DeleteUserController;


$router->get('/role/add', [CreateRolePageController::class]);
$router->post('/role/add', [CreateRoleController::class]);

$router->get('/school/type/add', [CreateSchoolTypePageController::class]);
$router->post('/school/type/add', [CreateTypeController::class]);


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

