<?php 

// $db settings in  database configuration

$configuration = [
    'settings' => [
        // Slim Settings
        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails' => true,
        'templates.path' => TEMPLATEDIR . $settings->template . DS,
        'db' => $db_settings
    ],
];

