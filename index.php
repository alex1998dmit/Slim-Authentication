<?php 

use Respect\Validation\Validator as v;


// Run autoload classes 
require __DIR__ . '/vendor/autoload.php';

// Constants 
require __DIR__ . '/config/constants.php';

// Database config
require __DIR__ . '/config/database.php';

// Slim configurations
require __DIR__ . '/config/configurations.php';

session_start();

$app = new \Slim\App($configuration);
$container = $app->getContainer();

//Database 

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function ($container) use ($capsule){
    return $capsule;
};

// Adding twigs

$container['auth'] = function($container) {
    return new \App\Auth\Auth;
};

$container['flash'] = function () {
    return new \Slim\Flash\Messages;
};


$container['view'] = function($container) {
    $view = new \Slim\Views\Twig(__DIR__ . '/templates', [
        'cache' => false,        
    ]);
    $router = $container->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
    $view->addExtension(new Slim\Views\TwigExtension($router, $uri));

    $view->getEnvironment()->addGlobal('auth', [
        'check' => $container->auth->check(),
        'user' => $container->auth->user(),
    ]);

    $view->getEnvironment()->addGlobal('flash', $container->flash);

    return $view;
};

// First Controller
$container['validator'] = function ($container) {
    return new App\Validation\Validator;
};

$container['HomeController'] = function($container) {
    return new App\Controllers\HomeController($container);
};

$container['AuthController'] = function($container) {
    return new App\Controllers\Auth\AuthController($container);
};

$container['csrf'] = function($container) {
    return new \Slim\Csrf\Guard;
};


$app->add( new App\Middleware\ValidationErrorMiddleware($container));
$app->add(new \App\Middleware\OldInputMiddleware($container));
$app->add(new \App\Middleware\CsrfViewMiddleware($container));

$app->add($container->csrf);

v::with('App\\Validation\\Rules');

require __DIR__ . '/app/routes/index.php';
$app->run();