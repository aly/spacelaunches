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

    public function get_launch_providers() : array {

        $response = $this->client->request('GET', 'lsp');

        if ($response->getStatusCode() === 200) {
            $body = $response->getBody();

            $launch_providers = json_decode((string)$body);
        }

        // TODO: make sure this doesnt fail when response is bad
        return $launch_providers->agencies;
    }

    public function get_launches(string $agency) {

        try {
            $response = $this->client->request('GET', 'launch', ['query' => ['lsp' => $agency, 'mode' => 'list']]);
            if ($response->getStatusCode() !== 200) {
                return [];
            }
        } catch (Exception $e) {
            return [];
        }

        $body = $response->getBody();
        $result = json_decode((string)$body);
        $numresults = $result->total;

        // Get the full list this time
        try {
            $response = $this->client->request('GET', 'launch', ['query' => ['lsp' => $agency, 'limit' => $numresults]]);
            if ($response->getStatusCode() !== 200) {
                return [];
            }
        } catch (Exception $e) {
            return [];
        }

        $body = $response->getBody();
        $launches = json_decode((string)$body);


        return $launches->launches;
    }

}
