<?php

class pgConnection {

    private $dsn;
    private $currStmt;

    protected function __construct() {
        $this->dsn = new PDO("pgsql:dbname=GolfSystem;host=localhost", "zaimazhar97", "Zaimzaim1@");

        return $this->dsn;
    }

    protected function executeQuery(string $query = null, array $data = null) {
        $this->currStmt = $this->sqlConn->prepare($query);

        if(!empty($data))
            $this->currStmt->execute($data);
        else
            $this->currStmt->execute();

        return $this->currStmt;
    }
}