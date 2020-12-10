<?php

class pgConnection {

    private $dsn;

    protected function __construct() {
        $this->dsn = new PDO("pgsql:dbname=GolfSystem;host=localhost", "zaimazhar97", "Zaimzaim1@");

        return $this->dsn;
    }

    protected function executeQuery() {

    }
}