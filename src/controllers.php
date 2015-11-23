<?php

use Symfony\Component\HttpFoundation\Request;

$app->get('/', function() use ($app) {
    return $app['twig']->render('home.html.twig',[
        'title' => "home"
    ]);
});
$app->get('/indexHotels','hotel_controller:indexHotels')->bind('indexHotels');
$app->get('/hotel/{id}','hotel_controller:viewHotel')->bind('viewHotel');
$app->match('/addHotel','hotel_controller:addHotel')->method('GET|POST')->bind('addHotel');

