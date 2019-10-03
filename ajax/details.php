<?php

$providerid = $_POST['provider'];

require_once(__DIR__ . '/../utils.php');
require_once(__DIR__ . '/../renderer.php');

$details = renderer::provider_details($providerid);

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../templates');
$twig = new \Twig\Environment($loader);

$render_data = ['provider' => $details];

echo $twig->render('details.html.twig', $render_data);

