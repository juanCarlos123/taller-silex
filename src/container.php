<?php
use Controllers\HotelController;
use Models\HotelModel;

$app['hotel_model'] = $app->share(function() use ($app) {
    return new HotelModel($app['db']);
});

$app['hotel_controller'] = $app->share(function() use ($app) {
    return new HotelController($app['twig'],$app['hotel_model'], $app['form.factory']);
});
