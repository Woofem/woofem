<?php

namespace Woofem;

class Response {

    protected $routes;

    public function __construct($params)
    {
        $this->routes = $params['routes'];
        $this->request = $params['request'];
    }

    public function deliverResponse()
    {
        if ($this->verifyPath() && $this->verifyMethod()) {
            $routeCallback = $this->routes->{$this->request->path}->{$this->request->method};
            $body = call_user_func($routeCallback);
            $this->setResponseBody($body);
        }
    }

    public function render()
    {

    }

    private function setHttpHeader($header = 200)
    {

    }

    private function setResponseBody($content)
    {
        echo $content;
    }

    private function verifyMethod()
    {
        $path = $this->request->path;
        return property_exists($this->routes->{$path}, $this->request->method);
    }

    private function verifyPath()
    {
        return property_exists($this->routes, $this->request->path);
    }
}