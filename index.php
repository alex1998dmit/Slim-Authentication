<?php 

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

// Adding twigs
$container['view'] = function($container) {
    $view = new \Slim\Views\Twig(__DIR__ . '/templates', [
        'cache' => false,        
    ]);
    $router = $container->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
    $view->addExtension(new Slim\Views\TwigExtension($router, $uri));
    return $view;
};

// First Controller
$container['HomeController'] = function($container) {
    return new App\Controllers\HomeController($container);
};

require __DIR__ . '/app/routes/index.php';
$app->run();