<?php

namespace php\database\connection;

use PDO;

class pgConnection {

    protected $dsn;

    // Database connection
    protected function __construct() {
        $this->dsn = new PDO("pgsql:dbname=GolfSystem;host=localhost", "zaimazhar97", "Zaimzaim1@");
    }
}