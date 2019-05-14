<?php

use Symfony\Component\HttpFoundation\Request;

$app->get('/staff', function () use ($app) {
    if ($_SESSION['loggedIn'] != false) {
        $database = new Database();
        $accounttype = $database->select("SELECT title FROM STAFF WHERE id = '" . $_SESSION['loggedIn'] . "';");
        $accounttype = $accounttype[0]->title;
        switch ($accounttype) {
            case 'STAFF':
                $ref = $database->select("SELECT * FROM menu ORDER BY name;");
                $data = $database->select("SELECT * FROM orders;");
                return $app['twig']->render('orders.html.twig', [
                    "title" => "Orders",
                    "menu" => $ref,
                    "orders" => $data,
                ]);
                break;

            case 'MANAGER':
                $stock = $database->selectAll("menu");
                $staff = $database->select("SELECT * FROM staff WHERE title = 'STAFF' ORDER BY id;");
                return $app['twig']->render('manager.html.twig', [
                    "title" => "Manager Dashboard",
                    "stock" => $stock,
                    "staff" => $staff,
                ]);
                break;

            case 'OWNER':
                $stock = $database->selectAll("menu");
                $staff = $database->select("SELECT * FROM staff WHERE title = 'STAFF' OR title = 'MANAGER' ORDER BY id;");
                return $app['twig']->render('manager.html.twig', [
                    "title" => "Manager Dashboard",
                    "stock" => $stock,
                    "staff" => $staff,
                ]);
                break;

            case 'ADMIN':
                $stock = $database->selectAll("menu");
                $staff = $database->select("SELECT * FROM staff WHERE title = 'STAFF' OR title = 'MANAGER' OR title = 'OWNER' ORDER BY id;");
                return $app['twig']->render('manager.html.twig', [
                    "title" => "Manager Dashboard",
                    "stock" => $stock,
                    "staff" => $staff,
                ]);
                break;
        }
    } else {
        return $app->redirect('/staff/login');
    }
});

$app->post('/staff', function (Request $request) use ($app) {
    $database = new Database();

    $orderid = $request->get("orderid", null);
    $staffid = $request->get("staffid", null);
    $memberid = $request->get("memberid", null);
    $itemid = $request->get("itemid", null);
    $itemstock = $request->get("itemstock", null);

    // Staff
    if ($orderid != null) {
        $database->update("UPDATE orders SET done = true WHERE id = $orderid;");
    }

    // Manager
    if ($staffid != null) {
        $password = password_hash($request->get('password'), PASSWORD_DEFAULT);
        $title = $request->get('title');
        $database->insert("INSERT INTO staff (id,password,title) VALUES ('$staffid','$password','$title');");
    }

    if ($memberid != null && $staffid == null) {
        $database->delete("DELETE FROM staff WHERE id = $memberid");
    }

    if ($itemid != null && $itemstock != null) {
        if ($itemstock == false) {
            $database->update("UPDATE menu SET stock = true WHERE id = $itemid;");
        } else {
            $database->update("UPDATE menu SET stock = false WHERE id = $itemid;");
        }
    }

    return $app->redirect("/staff");
});

$app->get('/staff/login', function () use ($app) {
    return $app['twig']->render('login.html.twig', [
        "title" => "Staff Login",
    ]);
});

$app->post('/staff/login', function (Request $request) use ($app) {
    $staffid = $request->get("staffid");
    $password = $request->get("password");
    $database = new Database();
    $data = $database->select("SELECT * FROM staff WHERE id = $staffid;");
    if (password_verify($password, $data[0]->password)) {
        $_SESSION['loggedIn'] = $staffid;
        return $app->redirect('/staff');
    }
});

$app->get('/staff/logout', function () use ($app) {
    $_SESSION['loggedIn'] = false;
    return $app->redirect('/staff/login');
});
