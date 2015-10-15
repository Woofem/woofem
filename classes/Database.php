<?php

/**
 * @file Database connection class.
 */

namespace Woofem;

class Database {

    public $connection;

    /**
     * Constructor function.
     * @param $config object
     *   Application database configuration object.
     */
    public function __construct($config) {
        $this->connection = new \PDO(
            'mysql:host=' . $config->db_host . ';dbname=' . $config->db_name,
            $config->db_user,
            $config->db_password,
            array(
                \PDO::ATTR_PERSISTENT => true
            )
        );
    }
}