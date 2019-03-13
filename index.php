<?php 



// Constants 
require __DIR__ . '/config/constants.php';

//

$db_settings =  array(
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'cornell',
    'username' => 'root',
    'password' => 'root',
    'prefix' => '',
    'charset' => 'utf8',
    'collation' => 'utf8_general_ci',
);

require __DIR__ . '/vendor/autoload.php';


session_start();

$configuration = [
    'settings' => [
        // Slim Settings
        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails' => true,
        'templates.path' => TEMPLATEDIR . $settings->template . DS,
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'cornell',
            'username' => 'root',
            'password' => 'root',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]
    ],
];


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