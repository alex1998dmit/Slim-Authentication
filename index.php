<?php 

define("DS", DIRECTORY_SEPARATOR);
define("ROOT", realpath(dirname(__DIR__)) . DS);
define("VENDORDIR", __DIR__. DS . "vendor" . DS);
define("ROUTEDIR", __DIR__ . DS . "app" . DS . "routes" . DS);
define("TEMPLATEDIR", __DIR__ .  DS . "templates" . DS);

require __DIR__ . '/vendor/autoload.php';

session_start();

$configuration = [
    'settings' => [
        // Slim Settings
        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails' => true,
        'templates.path' => TEMPLATEDIR . $settings->template . DS,
        // 'db' => [
        //     'driver' => 'mysql',
        //     'host' => 'localhost',
        //     'database' => 'database',
        //     'username' => 'root',
        //     'password' => 'das918das918',
        //     'charset'   => 'utf8',
        //     'collation' => 'utf8_unicode_ci',
        //     'prefix'    => '',
        // ]
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


require __DIR__ . '/app/routes/index.php';


$app->run();
