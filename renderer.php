<?php

require_once(__DIR__ . '/utils.php');
require_once(__DIR__ . '/api.php');

class renderer {

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
}
