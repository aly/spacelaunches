<?php

require_once(__DIR__ . '/utils.php');
require_once(__DIR__ . '/api.php');

class renderer {

    public static function launch_providers() {
        $renderdata = [];

        $api = new \api();
        $providers = $api->get_launch_providers();

        foreach ($providers as $prov) {
            $item = new \stdClass();
            $item->name = $prov->name;
            $item->id = $prov->id;

            $renderdata[] = $item;
        }

        return $renderdata;
    }

    /**
     * Function to get data for rendering launches list
     *
     * @param int $providerid
     */
    public static function launches_for_provider(int $providerid) {
        $renderdata = [];

        $api = new \api();
        $launches = $api->get_launches($providerid);

        foreach ($launches as $launch) {

            $launchitem = new \stdClass();
            $launchitem->name = $launch->name;
            $launchitem->netdate = $launch->net;
            $launchitem->status = \utils::get_launch_status_string($launch->status);
            $launchitem->failurereason = isset($launch->failreason) ? $launch->failreason : '';

            $renderdata[] = $launchitem;
        }

        return $renderdata;
    }

    /**
     * Get render data for a provider
     *
     * @param int $providerid
     */
    public static function provider_details(int $providerid) {
        $renderdata = [];

        $api = new \api();
        $provider = $api->get_provider_details($providerid);

        $details = new \stdClass();
        $details->name = $provider->name;
        $details->wikilink = $provider->wikiURL;

        include_once(__DIR__ . '/lib/iso_array.php');
        $details->country = $iso_array[$provider->countryCode];

        return $details;
    }
}
