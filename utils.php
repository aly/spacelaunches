<?php
/**
 * Utility functons or globally required includes
 */

require_once('vendor/autoload.php');

class utils {

    public static function get_launch_status_string(int $status) :string {
        $string = '';

        switch ($status) {
            case 1:
                $string = 'Green';
                break;
            case 2:
                $string = 'Red';
                break;
            case 3:
                $string = 'Success';
                break;
            case 4:
                $string = 'Failed';
                break;
        }

        return $string;
    }
}
