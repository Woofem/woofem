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
        var_dump($this->routes);
        var_dump($this->request);
        if ($this->verifyPath() && $this->verifyMethod()) {
            $this->setHttpHeader(200);

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