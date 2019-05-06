<?php
$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig');
});

$app->get('/about', function () use ($app) {
    return $app['twig']->render('about.html.twig', ["title" => "About"]);
});

$app->get('/cart', function () use ($app) {
    $database = new Database();
    $data = $database->selectAll("menu");
    return $app['twig']->render('cart.html.twig', ["title" => "Cart", "menu" => $data]);
});

$app->get('/coffee', function () use ($app) {
    $database = new Database();
    $data = $database->select("SELECT * FROM menu WHERE type = 'COFFEE' ORDER BY name;");
    return $app['twig']->render('menu.html.twig', ["title" => "Coffee Menu", "menu" => $data]);
});

$app->get('/contact', function () use ($app) {
    return $app['twig']->render('contact.html.twig', ["title" => "Contact"]);
});

$app->get('/food', function () use ($app) {
    $database = new Database();
    $data = $database->select("SELECT * FROM menu WHERE type = 'FOOD' ORDER BY name;");
    return $app['twig']->render('menu.html.twig', ["title" => "Food Menu", "menu" => $data]);
});

$app->get('/menu', function () use ($app) {
    $database = new Database();
    $data = $database->select("SELECT * FROM menu ORDER BY name;");
    return $app['twig']->render('menu.html.twig', ["title" => "Menu", "menu" => $data]);
});

$app->get('/tea', function () use ($app) {
    $database = new Database();
    $data = $database->select("SELECT * FROM menu WHERE type = 'TEA' ORDER BY name;");
    return $app['twig']->render('menu.html.twig', ["title" => "Tea Menu", "menu" => $data]);
});
