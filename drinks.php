<?php
require 'database.php';
require_once './vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('./views');
$twig = new \Twig\Environment($loader, [
    'cache' => false,
]);

$database = new Database();
$data = $database->select("SELECT * FROM menu WHERE type = 'DRINK';");

$template = $twig->load('drinks.html.twig');
echo $template->render(["title" => "Drinks Menu - ", "pageHeader" => "Drinks", "menu" => $data]);