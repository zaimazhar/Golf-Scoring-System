<?php

class pgConnection {

    private $dsn;

    protected function __construct() {
        $this->dsn = new PDO("pgsql:dbname=GolfSystem;host=localhost", "xxxx", "xxxx");

        return $this->dsn;
    }

    protected function executeQuery() {

    }
}