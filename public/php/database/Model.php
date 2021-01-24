<?php

class Model extends pgConnection {
    protected $sqlConn;
    private $currStmt;

    public function __construct() {
        $this->sqlConn = parent::__construct();
    }

    // protected function where(array $column) {
    //     foreach()
    // }

    // protected function buildQuery() {

    // }

    // protected function get() {
    //     return true;
    // }

    protected function save() {

    }

    private function executeQuery(string $query = null, array $data = null) {
        $this->currStmt = $this->sqlConn->prepare($query);

        if(!empty($data))
            $this->currStmt->execute($data);
        else
            $this->currStmt->execute();

        return $this->currStmt;
    }
}