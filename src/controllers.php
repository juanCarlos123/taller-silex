<?php

use Symfony\Component\HttpFoundation\Request;
$app->get('/', function (Request $request) {
    $welcome = "Welcome to my first aplication silex";
    return $welcome;
});

$app->match('/addHotel', function(Request $request) use ($app) {

    $form = $app['form.factory']->createBuilder('form')
        ->add('name','text')
        ->add('address','text')
        ->add('phone','text')
        ->getForm()
        ;

    $form->handleRequest($request);

    if($form->isValid()) {
        $data = $form->getData();
        $app['db']->insert('hotels',$data);
        error_log(print_r($data,true));
    }

    return $app['twig']->render('index.twig', ['form' => $form->createView()]);
})->method('GET|POST')->bind('addHotel');

