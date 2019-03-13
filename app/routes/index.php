<?php

use App\Controllers\HomeController;

$app->get('/hello/{name}', function ($request, $response, $args) {
    return $this->view->render($response, 'index.html', [
        'name' => $args['name']
    ]);
})->setName('profile');

$app->get('/hello', 'HomeController:index');

// $app->get('/hello', 'HomeController:showAll');
