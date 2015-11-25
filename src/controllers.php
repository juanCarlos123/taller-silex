<?php

use Symfony\Component\HttpFoundation\Request;

$app->mount('/user', $simpleUserProvider);

$app->get('/', function() use ($app) {
    return $app['twig']->render('home.html.twig',[
        'title' => "home"
    ]);
})->bind('home');

$app->get('/indexHotels','hotel_controller:indexHotels')->bind('indexHotels');
$app->get('/Hotel/{id}','hotel_controller:viewHotel')->bind('viewHotel');
$app->match('/addHotel','hotel_controller:addHotel')->method('GET|POST')->bind('addHotel');
$app->match('/editHotel','hotel_controller:editHotel')->method('GET|POST')->bind('editHotel');

$app->get('/indexRoomTypes','room_type_controller:indexRoomTypes')->bind('indexRoomTypes');
$app->get('/RoomType/{id}','room_type_controller:viewRoomType')->bind('viewRoomType');
$app->match('/addRoomType','room_type_controller:addRoomType')->method('GET|POST')->bind('addRoomType');
$app->match('/editRoomType','room_type_controller:editRoomType')->method('GET|POST')->bind('editRoomType');

