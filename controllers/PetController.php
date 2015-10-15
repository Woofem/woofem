<?php

namespace Woofem;

class PetController extends BaseController {

    /**
     * @var object $app
     * Bootstrap application object.
     */
    private $app;

    public function __construct($app)
    {
        parent::__construct($app);
        $this->app = $app;
    }


    public function getIdFromPetName($name)
    {
        $sql = 'SELECT PetId FROM pets WHERE Name = :name';
        $query = $this->db->connection->prepare($sql);
        $query->execute(array(':name' => $name));

        $result = $query->fetchAll();
        if ($result) {
            return $result[0]['PetId'];
        }
        return FALSE;
    }

    public function getPet($id)
    {
        $out = FALSE;
        if (!is_numeric($id)) {
            $id = $this->getIdFromPetName($id);
        }

        if ($id) {
            $sql = 'SELECT * FROM pets WHERE PetId = :id';
            $query = $this->db->connection->prepare($sql);
            $query->execute(array(':id' => $id));

            $result = $query->fetchAll();

            if ($result) {
                $out = $this->getPetObjectFromResult($result[0]);
            }
            return Filters::filterKeyValuePairs($out);
        }
        else {
            $this->app->send404Response();
        }
    }

    private function getPetObjectFromResult($result)
    {
        $pet = new \stdClass();
        $pet->id = $result['PetId'];
        $pet->name = $result['Name'];
        $pet->handle = $result['Handle'];
        $pet->email = $result['Email'];
        $pet->age = $result['Age'];
        $pet->breed = $result['Breed'];
        $pet->sex = $result['Sex'];
        $pet->species = $result['Species'];
        $pet->weight = $result['WeightRange'];
        $pet->skin = $result['SkinType'];
        $pet->energy = $result['EnergyLevel'];
        $pet->bio = $result['Biography'];
        $pet->peeves = $result['PetPeeves'];
        $pet->pleasures = $result['PetPleasures'];
        $pet->rel_desired = $result['RelDesired'];
        $pet->city = $result['City'];
        $pet->state = $result['State'];
        $pet->lat = $result['field_geo_lat'];
        $pet->lon = $result['field_geo_lon'];
        $pet->rel_status = $result['RelStatus'];

        return $pet;
    }
}