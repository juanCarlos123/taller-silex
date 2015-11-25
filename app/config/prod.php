<?php

$app['db.options'] = [
    'driver' => 'pdo_mysql',
    'host' => 'localhost',
    'dbname' => 'hotelperlas',
    'user' => 'tallersilex',
    'password' => 'tallersilex',
    'charset' => 'utf8',
];

$app['twig.path'] = __DIR__ . "/../templates";

$app['twig.options'] = [
    'debug' => true,
    'cache' => false,
    'charset' => 'utf8'
];

$app['user.options'] = [
    'emailConfirmation' => [
        'enabled' => false,
        'template' => '@user/email/confirm-email.twig'
    ]
];

$app['security.firewalls'] = [
    'login' => [
        'pattern' => '^/user/login$',
    ],
    'secured_area' => [
        'pattern' => '^.*$',
        'anonymous' => true,
        'remember_me' => [],
        'form' => [
            'login_path' => '/user/login',
            'check_path' => '/user/login_check',
        ],
        'logout' => [
            'logout_path' => '/user/logout'
        ],
        'users' => $app->share( function ($app) {
            return $app['user.manager'];
        })
    ]
];

$app['swiftmailer.options'] = [];

$app['security.access_rules'] = [
    ['^/user/list$','ROLE_ADMIN'],
    ['^/.*Hotel.*$','ROLE_ADMIN'],
    ['^/.*Room.*$','ROLE_ADMIN'],
    ['^/.*Reservation.*','ROLE_USER']
];
