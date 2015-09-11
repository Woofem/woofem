<?php

namespace Woofem;

class Response {

    protected $routes;

    public function __construct($params) {
        $this->routes = $params['routes'];
        $this->request = $params['request'];
    }

    public function render() {
        var_dump($this->routes);
        var_dump($this->request);
        echo 'Balls';
    }

}