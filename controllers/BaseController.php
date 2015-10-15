<?php

namespace Woofem;

class BaseController {

    public $db;

    public function __construct($app) {
        $this->db = new Database($app->config->database);
    }

    /**
     * Filter data.
     * @param $data string|int|array|object
     * @return mixed Filtered data
     */
    public function filterData($data) {
        $data_type = gettype($data);

        if ($data_type == 'array' || $data_type == 'object') {
            $data = Filters::filterKeyValuePairs($data);
        }
        elseif ($data_type == 'string') {
            $data = Filters::filterString($data);
        }
        return $data;
    }
}