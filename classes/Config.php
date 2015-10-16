<?php

/**
 * @file Read config.json for use as application configuration.
 */

namespace Woofem;

class Config {

    /**
     * @var string path to config.json file
     */
    private $config_file;

    /**
     * Constructor function.
     */
    public function __construct()
    {
        $this->config_file = __DIR__ . '/../config.json';
    }

    /**
     * Read configuration file and return as an object.
     * @return object
     * @throws \Exception
     */
    public function getConfig()
    {
        if (file_exists($this->config_file)) {
            return json_decode(file_get_contents($this->config_file));
        }
        else {
            throw new \Exception('config file does not exist');
        }
    }
}