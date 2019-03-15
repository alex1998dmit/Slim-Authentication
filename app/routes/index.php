<?php

use App\Controllers\HomeController;
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;

$app->get('/hello', 'HomeController:index')->setName('home');


$app->group('', function() {
    // Sign up
    $this->get('/auth/signup', 'AuthController:getSignUp')->setName('auth.signUp');
    $this->post('/auth/signup', 'AuthController:postSignUp');
    // Sign in 
    $this->get('/auth/signin', 'AuthController:getSignIn')->setName('auth.signIn');
    $this->post('/auth/signin', 'AuthController:postSignIn');
})->add(new GuestMiddleware($container));


// React testing 
$app->get('/react/test/users', 'HomeController:getUsers');

//Sign out 
$app->group('', function() {
    $this->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signOut');
})->add(new AuthMiddleware($container));