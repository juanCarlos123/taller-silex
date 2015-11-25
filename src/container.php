<?php
use Controllers\HotelController;
use Models\HotelModel;
use Controllers\RoomTypeController;
use Models\RoomTypeModel;

$app['hotel_model'] = $app->share(function() use ($app) {
    return new HotelModel($app['db']);
});

$app['hotel_controller'] = $app->share(function() use ($app) {
    return new HotelController($app['twig'],$app['hotel_model'], $app['form.factory']);
});

$app['room_type_model'] = $app->share(function() use ($app) {
    return new RoomTypeModel($app['db']);
});

$app['room_type_controller'] = $app->share(function() use ($app) {
    return new RoomTypeController($app['twig'],$app['room_type_model'], $app['form.factory']);
});
