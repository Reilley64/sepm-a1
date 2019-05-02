<?php
require 'database.php';
require_once './vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('./views');
$twig = new \Twig\Environment($loader, [
    'cache' => false,
]);

$database = new Database();
$data = $database->select("SELECT * FROM menu WHERE type = 'COFFEE' ORDER BY name;");

$template = $twig->load('menu.html.twig');
echo $template->render(["file" => $_SERVER['PHP_SELF'], "title" => "Coffee Menu - ", "pageHeader" => "Coffee", "menu" => $data]);