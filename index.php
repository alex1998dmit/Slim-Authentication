<?php 


require __DIR__ . '/vendor/autoload.php';

// Constants 
require __DIR__ . '/config/constants.php';

// Database config
require __DIR__ . '/config/database.php';

session_start();

$app = new \Slim\App($configuration);
$container = $app->getContainer();


$container['view'] = function($container) {
    $view = new \Slim\Views\Twig(TEMPLATEDIR, [
        'cache' => false,        
    ]);
    $router = $container->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
    $view->addExtension(new Slim\Views\TwigExtension($router, $uri));
    return $view;
};


$container['HomeController'] = function($container) {
    return new App\Controllers\HomeController;
};

// database

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection($db_settings);
$capsule->bootEloquent();
$capsule->setAsGlobal();
$app->db = $capsule;


require __DIR__ . '/app/routes/index.php';
$app->run();