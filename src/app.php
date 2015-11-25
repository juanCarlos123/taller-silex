<?php

use Silex\Application;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\RememberMeServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\SwiftmailerServiceProvider;
use SimpleUser\UserServiceProvider;
use Silex\Provider\SecurityServiceProvider;

$app = new Application();

$app->register(new DoctrineServiceProvider());
$app->register(new SecurityServiceProvider());
$app->register(new FormServiceProvider());
$app->register(new TranslationServiceProvider());
$app->register(new RememberMeServiceProvider());
$app->register(new SessionServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new UrlGeneratorServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new SwiftmailerServiceProvider());
$simpleUserProvider = new UserServiceProvider();
$app->register($simpleUserProvider);

return $app;
