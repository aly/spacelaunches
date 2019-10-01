<?php

require_once('utils.php');
require_once('api.php');

echo 'Lauch providers <br />';

$api = new \api();

$providers = $api->get_launch_providers();

foreach ($providers as $prov) {

    $name = $prov->name;
    var_dump($prov);

    echo "$name <br />";

}
