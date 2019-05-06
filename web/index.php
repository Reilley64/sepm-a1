<?php
require('../vendor/autoload.php');
require('./assets/classlib/database.php');

$app = new Silex\Application();

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/views',
));

require('./routes.php');

$app->run();
