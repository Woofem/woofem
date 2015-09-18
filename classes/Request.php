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


    public function __construct()
    {

    }

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

    private function getMethod()
    {
        return filter_var($_SERVER['REQUEST_METHOD'], FILTER_SANITIZE_STRIPPED);
    }

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

    private function getPost()
    {
        if (!empty($_POST)) {
            return Filters::filterKeyValuePairs($_POST);
        }
        return FALSE;
    }

    private function getQueryParameters()
    {
        if (!empty($_GET)) {
            return Filters::filterKeyValuePairs($_GET);
        }
        return FALSE;
    }

    public function getRequestObject()
    {
        $out = new \stdClass();
        $out->accepts = $this->getAccepts();
        $out->method = $this->getMethod();
        $out->parameters = $this->getQueryParameters();
        $out->post = $this->getPost();
        $out->path = $this->getPath();
        $out->time = $this->getTime();
        $out->user_agent = $this->getUserAgent();
        return $out;
    }

    private function getUserAgent()
    {
        return filter_var($_SERVER['HTTP_USER_AGENT'], FILTER_SANITIZE_STRIPPED);
    }

    private function getTime()
    {
        return filter_var($_SERVER['REQUEST_TIME'], FILTER_SANITIZE_NUMBER_INT);
    }
}