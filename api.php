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

        try  {
            $response = $this->client->request('GET', 'lsp');
            if ($response->getStatusCode() === 200) {
                $body = $response->getBody();

                $launch_providers = json_decode((string)$body);
            }
        } catch (Exception $e) {
            // API error return empty array
            return [];
        }

        return $launch_providers->agencies;
    }


    /**
     * Get launches for a provider
     *
     * @param int $agency
     */
    public function get_launches(int $agency) : array {

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
            // API error return empty array
            return [];
        }

        $body = $response->getBody();
        $launches = json_decode((string)$body);

        return $launches->launches;
    }

    /**
     * Get provider details
     */
    public function get_provider_details(int $agency) {
        try {
            $response = $this->client->request('GET', 'agency', ['query' => ['id' => $agency]]);
            if ($response->getStatusCode() !== 200) {
                return [];
            }
        } catch (Exception $e) {
            return [];
        }

        $body = $response->getBody();
        $result = json_decode((string)$body);

        if (count($result->agencies) > 1) {
            // Something went wrong and we have more than one result
            return [];
        }

        return $result->agencies[0];
    }
}
