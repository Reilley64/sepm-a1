<?php

use Symfony\Component\HttpFoundation\Request;

$app->get('/staff', function () use ($app) {
    if ($_SESSION['loggedIn'] != false) {
        return $app['twig']->render('orders.html.twig', [
            "title" => "Orders",
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


$app->get('/staff/logout', function () use ($app) {
    $_SESSION['loggedIn'] = false;
    return "Logged out";
});
