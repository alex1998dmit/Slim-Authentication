<?php

use App\Controllers\HomeController;

$app->get('/hello', 'HomeController:index');

$app->get('/auth/signup', 'AuthController:getSignUp')->setName('auth.signUp');
$app->post('/auth/signup', 'AuthController:getSignUp');
