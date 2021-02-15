<?php

namespace php\database;

use php\database\connection\pgConnection;
use php\misc\Facade;

class Model extends pgConnection {
    private $currStmt;
    private $arr_data = [];
    private static $check = [];

    protected function create($db, Array $datas) {
        $columns = "";
        $values = "";

        foreach($datas as $key => $data) {
            $columns .= "$key,";
            $values .= "?,";
            array_push($this->arr_data, Facade::sanitizeData($data));
        }

        $columns = substr($columns, 0, -1);
        $values = substr($values, 0, -1);
        $str = "INSERT INTO $db ($columns) VALUES ($values)";

        $this->executeQuery($str, $this->arr_data);
    }

    public static function where(array $checks) {        
        self::$check = $checks;
        return new static;
    }

    protected function get() {
        foreach(self::$check as $data) {
            echo $data[2];
        }
    }

    protected function buildQuery() {

    }

    private function executeQuery(string $query = null, array $data = null) {
        $this->sqlInjectionPreventor($data);
        $this->currStmt = $this->dsn->prepare($query);

        if(!empty($data))
            $this->currStmt->execute($data);
        else
            $this->currStmt->execute();
    }

    private function sqlInjectionPreventor(array $queryCheck) {
        if(Facade::checkThisInString(";", implode("", $queryCheck)) !== false) {
            echo "Not here, suckers";
            exit;
        }
    }
}