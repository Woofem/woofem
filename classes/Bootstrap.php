<?php

namespace Woofem;

class Bootstrap {

    /**
     * @var object
     *   Container object for application configuration
     */
    public $config;

    public $request;

    public $routes;

    public function __construct()
    {
        $config = new Config();
        $request = new Request();
        $this->config = $config->getConfig();
        $this->request = $request->getRequestObject();

        if (empty($this->routes)) {
            $this->routes = new \stdClass();
        }
    }

    public function registerRoute($path, $method, $callback)
    {
        if (!isset($this->routes->{$path})) {
            $this->routes->{$path} = new \stdClass();
        }
        $this->routes->{$path}->{$method} = $callback;
    }

    public function run()
    {
        $params = array(
            'routes' => $this->routes,
            'request' => $this->request
        );
        $response = new Response($params);
        $response->deliverResponse();
    }

}