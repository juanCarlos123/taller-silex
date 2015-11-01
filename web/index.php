<?php
chdir(__DIR__.'/../');
require_once 'vendor/autoload.php';

$app = require_once 'src/app.php';

require_once 'app/config/dev.php';
require_once 'src/container.php';
require_once 'src/controllers.php';

$app->run();
