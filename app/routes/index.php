<?php

use App\Controllers\HomeController;

$app->get('/hello', 'HomeController:index')->setName('home');

// Sign up
$app->get('/auth/signup', 'AuthController:getSignUp')->setName('auth.signUp');
$app->post('/auth/signup', 'AuthController:postSignUp');

// Sign in 
$app->get('/auth/signin', 'AuthController:getSignIn')->setName('auth.signIn');
$app->post('/auth/signin', 'AuthController:postSignIn');

//Sign out 
$app->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signOut');


// React testing 
$app->get('/react/test/users', 'HomeController:getUsers');
