<?php

require_once('utils.php');
require_once('api.php');

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$twig = new \Twig\Environment($loader);

$api = new \api();
$providers = $api->get_launch_providers();

$launchproviderdata = [];

foreach ($providers as $prov) {
    $item = new \stdClass();
    $item->name = $prov->name;
    $item->id = $prov->id;

    $launchproviderdata[] = $item;
}

$render_data = [
    'providers' => $launchproviderdata,
    'launches' => []
];

echo $twig->render('index.html.twig', $render_data);


