<?php

class PropertyLoader
{
    public static $properties;

    public static function load() {
        $config = \Codeception\Configuration::config();

        if (strtoupper($config['language']) == 'GERMAN') {
            $properties = require __DIR__.'/../resources/au.php';
            echo "read from au.php";
        } else if (strtoupper($config['language']) == 'ITALIAN'){
            $properties = require '../ita.php';
            echo "read from ita.php";
        } else {
            exit("Invalid language selection:" . $config['language']);
        }

        return $properties;
    }

    public static function getBaseUrl() {
        self::load();
        return self::$properties['BASE_URL'];
    }

}