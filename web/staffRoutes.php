<?php

use Symfony\Component\HttpFoundation\Request;

$app->get('/staff', function () use ($app) {
    if ($_SESSION['loggedIn'] != false) {
        $database = new Database();
        $ref = $database->select("SELECT * FROM menu ORDER BY name;");
        $data = $database->select("SELECT * FROM orders WHERE done = FALSE;");
        return $app['twig']->render('orders.html.twig', [
            "title" => "Orders",
            "menu" => $ref,
            "orders" => $data,
        ]);
    } else {
        return $app->redirect('/staff/login');
    }
});

$app->get('/staff/manager', function () use ($app) {
    if ($_SESSION['loggedIn'] != false) {
        $database = new Database();
        $stock = $database->select("SELECT * FROM menu ORDER BY name;");
        $staff = $database->select("SELECT * FROM staff WHERE title = 'STAFF' ORDER BY id;");
        return $app['twig']->render('manager.html.twig', [
            "title" => "Manager Dashboard",
            "stock" => $stock,
            "staff" => $staff,
        ]);
    } else {
        return $app->redirect('/staff/login');
    }
});

$app->post('/staff/manager', function (Request $request) use ($app) {
    $staffid = $request->get("staffid", null);
    $database = new Database();
    if($staffid != null){
        $password = password_hash($request->get('password'), PASSWORD_DEFAULT);
        $title = $request->get('title');
        $database->insert("INSERT INTO staff (id,password,title) VALUES ('$staffid','$password','$title');");
    }
    $memberid = $request->get("memberid", null);
    if ($memberid != null && $staffid == null) {
        $database->delete("DELETE FROM staff WHERE id = $memberid");
    } else {
        $itemid = $request->get("itemid");
        $itemstock = $request->get("itemstock");
        if ($itemstock == false) {
            $database->update("UPDATE menu SET stock = true WHERE id = $itemid;");
        } else {
            $database->update("UPDATE menu SET stock = false WHERE id = $itemid;");
        }
    }
    return $app->redirect('/staff/manager');
});

$app->get('/staff/login', function () use ($app) {
    return $app['twig']->render('login.html.twig', [
        "title" => "Staff Login",
    ]);
});

$app->get('/staff/logout', function () use ($app) {
    $_SESSION['loggedIn'] = false;
    return $app->redirect('/staff/login');
});

$app->post('/staff/login', function (Request $request) use ($app) {
    $staffid = $request->get("staffid");
    $password = $request->get("password");
    $database = new Database();
    $data = $database->select("SELECT * FROM staff WHERE id = $staffid;");
    if (password_verify($password, $data[0]->password)) {
        if ($data[0]->title == "OWNER" || $data[0]->title == "ADMIN" || $data[0]->title == "MANAGER") {
            $_SESSION['loggedIn'] = $staffid;
            return $app->redirect('/staff/manager');
        } else {
            $_SESSION['loggedIn'] = $staffid;
            return $app->redirect('/staff');
        }
    } else {
        return $password;
    }
});

$app->post('/staff', function (Request $request) use ($app) {
    $orderid = $request->get("orderid");
    $database = new Database();
    $data = $database->update("UPDATE orders SET done = true WHERE id = $orderid;");
    return $app->redirect('/staff');
});
