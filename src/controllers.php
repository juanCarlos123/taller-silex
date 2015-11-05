<?php

use Symfony\Component\HttpFoundation\Request;
$app->get('/','hotel_controller:indexHotels')->bind('indexHotels');

$app->match('/addHotel','hotel_controller:addHotel')->method('GET|POST')->bind('addHotel');

