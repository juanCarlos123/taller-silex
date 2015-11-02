<?php

use Symfony\Component\HttpFoundation\Request;
$app->get('/', function (Request $request) {
    $welcome = "Welcome to my first aplication silex";
    return $welcome;
});

$app->match('/addHotel', function(Request $request) use ($app) {

    $form = $app['form.factory']->createBuilder('form')
        ->add('name','text',['attr' => ['class' => 'form-control']])
        ->add('address','text',['attr' => ['class' => 'form-control']])
        ->add('mobile','text',['attr' => ['class' => 'form-control']])
        ->add('phone','text',['attr' => ['class' => 'form-control']])
        ->getForm()
        ;

    $form->handleRequest($request);

    if($form->isValid()) {
        $data = $form->getData();
        $app['db']->insert('hotels',$data);
    }

    return $app['twig']->render('index.twig', ['form' => $form->createView()]);
})->method('GET|POST')->bind('addHotel');

