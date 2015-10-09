<?php

namespace Woofem;

class PetController extends BaseController {

    public function __construct($app) {
        parent::__construct($app);
    }

    public function getPet($id) {
        echo $id;
        var_dump($this);
        $result = $this->db->connection->query('SELECT * FROM pet')->fetchAll();
        return $result;
    }
}