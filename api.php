<?php

require_once('utils.php');

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class api {

    private $client = null;

    public function __construct () {
        $this->client = new Client ([
            'base_uri' => 'https://launchlibrary.net/1.4/',
            'timeout' => 2.0,
        ]);
    }


    public function get_launch_providers() : array{

        $response = $this->client->request('GET', 'lsp'); //, ['query' => ['islsp' => 1]]);

        if ($response->getStatusCode() === 200) {
            $body = $response->getBody();

            $launch_providers = json_decode((string)$body);
        }

        return $launch_providers->agencies;
    }



}
