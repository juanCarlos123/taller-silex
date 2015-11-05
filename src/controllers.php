<?php

use Symfony\Component\HttpFoundation\Request;
$app->get('/', function (Request $request) {
    $welcome = "Welcome to my first aplication silex";
    return $welcome;
});

$app->match('/addHotel','hotel_controller:addHotel')->method('GET|POST')->bind('addHotel');

