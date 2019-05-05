<?php
require('../vendor/autoload.php');
require('./assets/classlib/database.php');

$app = new Silex\Application();

$app->register(new Silex\Provider\TwigServiceProvider(), array(
  'twig.path' => __DIR__.'/views',
));

// Routes Start
$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig');
});

$app->get('/about', function () use ($app) {
    return $app['twig']->render('about.html.twig');
});

$app->get('/cart', function () use ($app) {
    $database = new Database();
    $data = $database->selectAll("menu");
    return $app['twig']->render('cart.html.twig', ["file" => $_SERVER['PHP_SELF'], "menu" => $data]);
});

$app->get('/coffee', function () use ($app) {
    $database = new Database();
    $data = $database->select("SELECT * FROM menu WHERE type = 'COFFEE' ORDER BY name;");
    return $app['twig']->render('menu.html.twig', ["file" => $_SERVER['PHP_SELF'], "title" => "Coffee Menu - ", "pageHeader" => "Coffee", "menu" => $data]);
});

$app->get('/contact', function () use ($app) {
    return $app['twig']->render('contact.html.twig');
});

$app->get('/food', function () use ($app) {
    $database = new Database();
    $data = $database->select("SELECT * FROM menu WHERE type = 'FOOD' ORDER BY name;");
    return $app['twig']->render('menu.html.twig', ["file" => $_SERVER['PHP_SELF'], "title" => "Food Menu - ", "pageHeader" => "Food", "menu" => $data]);
});

$app->get('/menu', function () use ($app) {
    $database = new Database();
    $data = $database->select("SELECT * FROM menu ORDER BY name;");
    return $app['twig']->render('menu.html.twig', ["file" => $_SERVER['PHP_SELF'], "title" => "Menu Menu - ", "pageHeader" => "Menu", "menu" => $data]);
});

$app->get('/tea', function () use ($app) {
    $database = new Database();
    $data = $database->select("SELECT * FROM menu WHERE type = 'TEA' ORDER BY name;");
    return $app['twig']->render('menu.html.twig', ["file" => $_SERVER['PHP_SELF'], "title" => "Tea - ", "pageHeader" => "Tea", "menu" => $data]);
});
// Routes End

$app->run();
