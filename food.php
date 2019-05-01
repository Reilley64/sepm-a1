<?php
require_once './vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('./views');
$twig = new \Twig\Environment($loader, [
    'cache' => false,
]);

$template = $twig->load('food.html.twig');
echo $template->render(["pageHeader" => "Food"]);