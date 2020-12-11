<?php

class pgConnection {

    private $dsn;
    private $currStmt;

    protected function __construct() {
        $this->dsn = new PDO("pgsql:dbname=GolfSystem;host=localhost", "xxxx", "xxxx");

        return $this->dsn;
    }

    protected function executeQuery(string $query = null, $value_to_store = null) {
        if(!$query) return;

        $this->currStmt = $this->dsn->prepare($query);

        if(!empty($value_to_store)) {
            $this->currStmt->execute();
        } else {
            $this->currStmt->execute($value_to_store);
        }

        return $this->currStmt;
    }
}