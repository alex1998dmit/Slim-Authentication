<?php 

define("DS", DIRECTORY_SEPARATOR);
define("ROOT", realpath(dirname(__DIR__)) . DS);
define("VENDORDIR", ROOT . "vendor" . DS);
define("ROUTEDIR", ROOT . "src" . DS . "routes" . DS);
define("TEMPLATEDIR", ROOT . "templates" . DS);
define("LANGUAGEDIR", ROOT . "languages" . DS);

require __DIR__ . '/vendor/autoload.php';

$configuration = [
    'settings' => [
        // Slim Settings
        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails' => true,
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


$app->get('/', function ($request, $response, $args) {
    return $response->write("Hello");
});

$app->run();
