<?php

use Silex\Application;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\TranslationServiceProvider;

$app = new Application();

$app->register(new UrlGeneratorServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new DoctrineServiceProvider());
$app->register(new FormServiceProvider());
$app->register(new TranslationServiceProvider());

return $app;
