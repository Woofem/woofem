<?php

namespace Woofem;

class PetController extends BaseController {

    public function __construct($app) {
        parent::__construct($app);
    }


    public function getIdFromPetName($name)
    {
        $sql = 'SELECT pid FROM pet WHERE Name = :name';
        $query = $this->db->connection->prepare($sql);
        $query->execute(array(':name' => $name));

        $result = $query->fetchAll();
        return $result[0]['pid'];
    }

    public function getPet($id)
    {
        if (!is_numeric($id)) {
            $id = $this->getIdFromPetName($id);
        }
        $result = $this->db->connection->query('SELECT * FROM pet')->fetchAll();
        return (object)$result[0];
    }
}