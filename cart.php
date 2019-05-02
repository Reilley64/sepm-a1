<?php
require_once './vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('./views');
$twig = new \Twig\Environment($loader, [
    'cache' => false,
]);

$template = $twig->load('cart.html.twig');
echo $template->render(["file" => $_SERVER['PHP_SELF']]);