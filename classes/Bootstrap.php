<?php

/**
 * @file Main application execution entry point.
 */

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

    /**
     * Get part of url path by place in the path.
     *   example: /pets/bob if supplied an index of 1 will return "bob"
     * @param int $index Place in URL path
     * @return string | FALSE
     *   Returns string of place in URL or FALSE if index is not present.
     */
    public function getUrlPart($index)
    {
        $path_parts = explode('/', $this->request->path);
        if (isset($path_parts[$index])) {
            return $path_parts[$index];
        }
        else {
            return FALSE;
        }
    }

    /**
     * Register routes that will be valid endpoint in the application.
     *
     * @param $path string
     *   URL path to register.
     * @param $method string
     *   HTTP method to register.
     * @param $callback
     *   Callback function that executes when path and method
     *   match the requested path and method.
     */
    public function registerRoute($path, $method, $callback)
    {
        if (!isset($this->routes->{$path})) {
            $this->routes->{$path} = new \stdClass();
        }
        $this->routes->{$path}->{$method} = $callback;
    }

    /**
     * Wrapper for $Template->render function.
     * Here for scope reasons, kinda clumsy IMO.
     *
     * @param $filename string
     *   Template filename sans .html.php
     * @param $data object
     *   Data to be passed to template file.
     */
    public function render($filename, $data)
    {
        $template = new Template($this->config);
        $template->render($filename, $data, $this);
    }

    /**
     * Main execution flow of application.
     */
    public function run()
    {
        $params = array(
            'routes' => $this->routes,
            'request' => $this->request
        );
        $response = new Response($params);
        $response->deliverResponse($this);
    }

    /**
     * End application execution and send a 404 response.
     */
    public function send404Response()
    {
        $template = new Template($this->config);
        header('HTTP/1.1 404 Not Found');
        echo $template->render('404', null, $this);
        exit;
    }
}