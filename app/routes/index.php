<?php

use App\Controllers\HomeController;

$app->get('/hello', 'HomeController:index');

// $app->get('/hello', 'HomeController:showAll');
