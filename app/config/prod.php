<?php

$app['db.options'] = [
    'driver' => 'pdo_mysql',
    'host' => 'localhost',
    'dbname' => 'tallersilex',
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
