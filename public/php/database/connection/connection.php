<?php

class pgConnection {

    private $dsn;
    private $currStmt;

    protected function __construct() {
        $this->dsn = new PDO("pgsql:dbname=GolfSystem;host=localhost", "xxxx", "xxxx");

        return $this->dsn;
    }

    protected function executeQuery(string $query = null, $value_to_store = null) {
        $this->currStmt = $this->sqlConn->prepare($query);

        if(!empty($data))
            $this->currStmt->execute($data);
        else
            $this->currStmt->execute();

        return $this->currStmt;
    }
}