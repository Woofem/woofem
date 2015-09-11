<?php

namespace Woofem;

class Config {

    /**
     * @var string path to config.json file
     */
    private $config_file;

    public function __construct()
    {
        $this->config_file = __DIR__ . '/../config.json';
    }

    public function getConfig()
    {
        return json_decode(file_get_contents($this->config_file));
    }
}