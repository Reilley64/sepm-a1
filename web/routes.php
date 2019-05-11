<?php

use Symfony\Component\HttpFoundation\Request;

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig', [
        "title" => null,
    ]);
});

$app->get('/about', function () use ($app) {
    return $app['twig']->render('about.html.twig', [
        "title" => "About",
    ]);
});

$app->get('/cart', function () use ($app) {
    $database = new Database();
    $data = $database->selectAll("menu");
    return $app['twig']->render('cart.html.twig', [
        "title" => "Cart",
        "menu" => $data,
    ]);
});

$app->get('/cart/checkout', function () use ($app) {
    $database = new Database();
    $data = $database->selectAll("menu");
    return $app['twig']->render('checkout.html.twig', [
        "title" => "Checkout",
        "menu" => $data,
    ]);
});

$app->post('/cart/checkout', function (Request $request) use ($app) {
    $items = $request->get("cart");
    $customer = $request->get("name");
    $database = new Database();
    $id = $database->select("SELECT id FROM orders ORDER BY id DESC;");
    $id = $id[0]->id + 1;
    $result = $database->insert("INSERT INTO orders (id, items, customer) VALUES (" . $id . ", '" . $items . "', '" . $customer . "');");
    if ($result) {
        return $app->redirect('/');
    }
    /*TODO: Else statement*/
});

$app->get('/contact', function () use ($app) {
    return $app['twig']->render('contact.html.twig', [
        "title" => "Contact",
    ]);
});

$app->get('/item/{id}', function ($id) use ($app) {
    $database = new Database();
    $data = $database->select("SELECT * FROM menu WHERE id = '" . $id . "';");
    return $app['twig']->render('item.html.twig', [
        "title" => ucfirst($data[0]->name),
        "item" => $data[0],
    ]);
});

$app->get('/menu', function () use ($app) {
    $database = new Database();
    $data = $database->select("SELECT * FROM menu ORDER BY name;");
    return $app['twig']->render('menu.html.twig', [
        "title" => "Menu",
        "menu" => $data,
    ]);
});

$app->get('/menu/coffee', function () use ($app) {
    $database = new Database();
    $data = $database->select("SELECT * FROM menu WHERE type = 'COFFEE' ORDER BY name;");
    return $app['twig']->render('menu.html.twig', [
        "title" => "Coffee Menu",
        "menu" => $data,
    ]);
});

$app->get('/menu/food', function () use ($app) {
    $database = new Database();
    $data = $database->select("SELECT * FROM menu WHERE type = 'FOOD' ORDER BY name;");
    return $app['twig']->render('menu.html.twig', [
        "title" => "Food Menu",
        "menu" => $data,
    ]);
});

$app->get('/menu/tea', function () use ($app) {
    $database = new Database();
    $data = $database->select("SELECT * FROM menu WHERE type = 'TEA' ORDER BY name;");
    return $app['twig']->render('menu.html.twig', [
        "title" => "Tea Menu",
        "menu" => $data,
    ]);
});
