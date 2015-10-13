<?php

namespace Woofem;

class PetController extends BaseController {

    public function __construct($app)
    {
        parent::__construct($app);
    }


    public function getIdFromPetName($name)
    {
        $sql = 'SELECT pid FROM pet WHERE Name = :name';
        $query = $this->db->connection->prepare($sql);
        $query->execute(array(':name' => $name));

        $result = $query->fetchAll();
        if ($result) {
            return $result[0]['pid'];
        }
        return FALSE;
    }

    public function getPet($id)
    {
        if (!is_numeric($id)) {
            $id = $this->getIdFromPetName($id);
        }
        //$result = $this->db->connection->query('SELECT * FROM pet')->fetchAll();
        $sql = 'SELECT * FROM pet WHERE pid = :id';
        $query = $this->db->connection->prepare($sql);
        $query->execute(array(':id' => $id));

        $result = $query->fetchAll();

        if ($result) {
            return (object)$result[0];
        }
        return FALSE;
    }
}