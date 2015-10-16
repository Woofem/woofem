<?php

namespace Woofem;

class Request
{
    /**
     * @var string
     *
     * Request URI
     */
    public $path;

    /**
     * @var string
     *
     * Request Method
     */
    public $method;

    /**
     * @var object
     *
     * Query parameters as key->value pairs
     */
    public $query_params;

    /**
     * Constructor function.
     */
    public function __construct()
    {
        $this->method = $this->getMethod();
    }

    /**
     * Get Accept HTTP header from request and filter it.
     * @return string
     *   Filtered Accept header
     */
    private function getAccepts()
    {
        $out = array();
        $http_accepts = $_SERVER['HTTP_ACCEPT'];
        $exploded = explode(',', $http_accepts);
        foreach ($exploded as $accept) {
            $out[] = filter_var($accept, FILTER_SANITIZE_STRIPPED);
        }
        return $out;
    }

    /**
     * Get HTTP method from request.
     * @return string
     *   Filtered HTTP method
     */
    private function getMethod()
    {
        return filter_var($_SERVER['REQUEST_METHOD'], FILTER_SANITIZE_STRIPPED);
    }

    /**
     * Get path of request.
     * @return string
     *   Filtered request path.
     */
    private function getPath()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $components = explode('?', $uri);
        $path = $components[0];
        if ($path != '/') {
            $path = trim($path, '/');
        }
        return filter_var($path, FILTER_SANITIZE_STRIPPED);
    }

    /**
     * Filter and return $_POST.
     * @return object
     */
    private function getPost()
    {
        return Filters::filterKeyValuePairs($_POST);

    }

    /**
     * Filter HTTP PUT params.
     * @return bool|object
     */
    private function getPut()
    {
        $vars = json_decode(file_get_contents("php://input"));
        if ($vars) {
            return Filters::filterKeyValuePairs($vars);
        }
        return FALSE;
    }

    /**
     * Filter and return $_GET.
     * @return object
     */
    private function getQueryParameters()
    {
        return Filters::filterKeyValuePairs($_GET);
    }

    /**
     * Read useful bits of HTTP request, filter them and return them.
     * @return object
     */
    public function getRequestObject()
    {
        $out = new \stdClass();
        $out->accepts = $this->getAccepts();
        $out->method = $this->method;
        if (!empty($_GET)) {
            $out->parameters = $this->getQueryParameters();
        }
        if (!empty($_POST)) {
            $out->post = $this->getPost();
        }
        if ($this->method == 'PUT') {
            $out->put = $this->getPut();
        }
        $out->path = $this->getPath();
        $out->time = $this->getTime();
        $out->user_agent = $this->getUserAgent();
        return $out;
    }

    /**
     * Filter and return browser user agent.
     * @return string
     */
    private function getUserAgent()
    {
        return filter_var($_SERVER['HTTP_USER_AGENT'], FILTER_SANITIZE_STRIPPED);
    }

    /**
     * Filter and return HTTP request time.
     * @return string
     */
    private function getTime()
    {
        return filter_var($_SERVER['REQUEST_TIME'], FILTER_SANITIZE_NUMBER_INT);
    }
}