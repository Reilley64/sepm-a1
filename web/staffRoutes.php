<?php

use Symfony\Component\HttpFoundation\Request;

$app->get('/staff', function () use ($app) {
    if ($_SESSION['loggedIn'] != false) {
        $database = new Database();
        $ref = $database->select("SELECT * FROM menu ORDER BY name;");
        $data = $database->select("SELECT * FROM orders WHERE done = FALSE ");
        return $app['twig']->render('orders.html.twig', [
            "title" => "Orders",
            "menu" => $ref,
            "orders" => $data,
        ]);
    } else {
        return $app->redirect('/staff/login');
    }
});

$app->get('/staff/login', function () use ($app) {
    return $app['twig']->render('login.html.twig', [
        "title" => null,
    ]);
});

$app->get('/staff/logout', function () use ($app) {
    $_SESSION['loggedIn'] = false;
    return "Logged out";
});

$app->post('/staff/login', function (Request $request) use ($app) {
    $staffid = $request->get("staffid");
    $password = $request->get("password");
    $database = new Database();
    $data = $database->select("SELECT * FROM staff WHERE id = $staffid;");
    if(password_verify($password, $data[0]->password)) {
        $_SESSION['loggedIn'] = $staffid;
        return $app->redirect('/staff');
    } else {
        return $password;
    }
});
