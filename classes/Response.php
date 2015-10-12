<?php

namespace Woofem;

class Response {

    protected $routes;

    public function __construct($params)
    {
        $this->routes = $params['routes'];
        $this->request = $params['request'];
    }

    public function deliverResponse($app)
    {
        if ($path = $this->verifyPath()) {
            if ($this->verifyMethod($path)) {
                $routeCallback = $this->routes->{$path}->{$this->request->method};
                $body = call_user_func($routeCallback, $app);
                $this->setResponseBody($body);
            }
        }
    }

    public function get_path_parts($path)
    {
        return explode('/', $path);
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

    private function verifyMethod($path)
    {
        return property_exists($this->routes->{$path}, $this->request->method);
    }

    private function verifyPath()
    {
        foreach ($this->routes as $path => $method_and_such) {
            if (fnmatch($path, $this->request->path)) {
                return $path;
            }
        }
        return FALSE;
    }
}