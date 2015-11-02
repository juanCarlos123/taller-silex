<?php

use Symfony\Component\HttpFoundation\Request;
$app->get('/', function (Request $request) {
    $welcome = "Welcome to my first aplication silex";
    return $welcome;
});

$app->match('/addHotel', function(Request $request) use ($app) {

    $form = $app['form.factory']->createBuilder('form')
        ->add('name','text'),
        ->add('address','text'),
        ->add('phone','text'),
        ->getForm()
        ;
    error_log(date('Y'));

    $form->handleRequest($request);

    if($form->isValid()) {
        $data = $form->getData();
        error_log(print_r($data,true));
    }

    return $app['twig']->render('index.twig', ['form' => $form->createView()]);
})->method('GET|POST')->bind('addHotel');

