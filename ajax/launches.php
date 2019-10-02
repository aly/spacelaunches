<?php

$providerid = $_POST['provider'];

require_once(__DIR__ . '/../utils.php');
require_once(__DIR__ . '/../renderer.php');

$launches = renderer::launches_for_provider($providerid);

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../templates');
$twig = new \Twig\Environment($loader);

$render_data = ['launches' => $launches];

echo $twig->render('launches.html.twig', $render_data);
