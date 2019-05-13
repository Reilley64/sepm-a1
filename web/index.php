<?php
session_start();

require('../vendor/autoload.php');
require('./assets/classlib/database.php');

$app = new Silex\Application();
$app['debug'] = true;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/views',
));

if(!isset($_SESSION['loggedIn'])) {
    $_SESSION['loggedIn'] = false;
}

require('./customerRoutes.php');
require('./staffRoutes.php');

$app->run();
