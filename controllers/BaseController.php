<?php

namespace Woofem;

class BaseController {

    public $db;

    public function __construct($app) {
        $this->db = new Database($app->config->database);
    }
}