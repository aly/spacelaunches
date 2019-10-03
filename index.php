<?php

require_once('utils.php');
require_once('api.php');

$launchproviderdata = renderer::launch_providers();

$render_data = [
    'providers' => $launchproviderdata,
    'launches' => []
];

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$twig = new \Twig\Environment($loader);
echo $twig->render('index.html.twig', $render_data);

