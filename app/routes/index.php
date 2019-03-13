<?php

use App\Controllers\HomeController;

$app->get('/hello', 'HomeController:index')->setName('home');

$app->get('/auth/signup', 'AuthController:getSignUp')->setName('auth.signUp');
$app->post('/auth/signup', 'AuthController:postSignUp');
