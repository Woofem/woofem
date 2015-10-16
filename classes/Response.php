<?php

/**
 * Response class.
 */

namespace Woofem;

class Response {

    /**
     * @var object Registered routes.
     */
    protected $routes;

    /**
     * @var object Filtered HTTP request object.
     */
    protected $request;

    /**
     * Constructor function.
     * @param $params array
     *   $params = array(
     *     'routes' => /stdClass
     *     'request' => /stdClass
     *   )
     */
    public function __construct($params)
    {
        $this->routes = $params['routes'];
        $this->request = $params['request'];
    }

    /**
     * Verify request matches registered paths, deliver response.
     * @param $app
     */
    public function deliverResponse($app)
    {
        if ($path = $this->verifyPath()) {
            if ($this->verifyMethod($path)) {
                $routeCallback = $this->routes->{$path}->{$this->request->method};
                $body = call_user_func($routeCallback, $app);
                $this->setResponseBody($body);
                return;
            }
        }
        $app->send404Response();
    }

    /**
     * Get parts of url as an array.
     * @param $path URL path
     * @return array
     */
    public function get_path_parts($path)
    {
        return explode('/', $path);
    }

    /**
     * echo content.
     * @param $content string
     */
    private function setResponseBody($content)
    {
        echo $content;
    }

    /**
     * Verify that HTTP method is registered for a path.
     * @param $path Request path
     * @return bool
     */
    private function verifyMethod($path)
    {
        return property_exists($this->routes->{$path}, $this->request->method);
    }

    /**
     * Verify that requested path matched one of the registered paths.
     * @return bool|string
     */
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