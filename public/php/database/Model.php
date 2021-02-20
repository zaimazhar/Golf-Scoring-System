<?php

namespace php\database;

use php\database\connection\pgConnection;
use php\misc\Helper;
use PDO;

class Model extends pgConnection {
    private $currStmt;
    private $currQuery;
    private $arr_data = [];

    /**
     * Initialize the database connection
     */
    protected function __construct() {
        parent::__construct();
    }

    public function startTransaction() {
        $this->dsn->beginTransaction();
    }

    public function endTransaction() {
        $this->dsn->commit();
    }

    /**
     * Create new data
     */
    public function create(string $db, array $datas) {
        $columns = "";
        $values = "";

        foreach($datas as $key => $data) {
            $columns .= "$key,";
            $values .= "?,";
            array_push($this->arr_data, $data);
        }

        $columns = substr($columns, 0, -1);
        $values = substr($values, 0, -1);
        $this->currQuery = "INSERT INTO $db ($columns) VALUES ($values)";

        return $this->executeQuery($this->currQuery, $this->arr_data);
    }

    /**
     * WHERE clause (NEEDS REVIEW)
     */
    // public function where(array $checks) {        
    //     $this->executeQuery("SELECT ", )
    // }

    /**
     * Get all data after querying
     */
    public function get() {
        return $this->currStmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * DELETE Query
     */
    public function delete(string $table, int $id) {
        return $this->executeQuery("DELETE FROM $table WHERE id=?", [$id]);
    }

    /**
     * UPDATE Query
     */
    public function update(string $table, array $datas) {
        $cols = "";
        foreach($datas as $col => $data) {
            if($col !== "id") {
                $cols .= "$col=$data,";
            }
        }

        $cols = substr($cols, 0, -1);
        return $this->executeQuery("UPDATE $table SET $cols WHERE id=?", [$datas['id']]);
    }

    /**
     * Find the data based on the given id
     */
    public function find(string $table, int $id) {
        return $this->executeQuery("SELECT * FROM $table WHERE id=?", [$id]);
    }

    /**
     * Fetch all data of the given table
     */
    public function all(string $table) {
        return $this->executeQuery("SELECT * FROM $table", null);
    }

    /**
     * SELECT data based on table, with specific columns and id (if applicable)
     */
    public function select(string $table, array $cols = null, array $wheres) {
        $choose = "";

        foreach($wheres as $key => $data) {
            $$key = $key;
            $this->currQuery .= "$key=? AND ";
            array_push($this->arr_data, $data);
        }

        $this->currQuery = substr($this->currQuery, 0, -5);

        if($cols === null) {
            $choose = "*";
        } else {
            foreach($cols as $col) {
                $choose .= "$col,";
            }
            $choose = substr($choose, 0, -1);
        }

        $this->currQuery = "SELECT $choose FROM $table WHERE " . $this->currQuery;

        return $this->executeQuery($this->currQuery, $this->arr_data);
    }

    /**
     * Execute the given query along with the data
     */
    private function executeQuery(string $query = null, array $data = null) {
        if($data !== null)
            $this->sqlInjectionPreventor($data);
        
        $this->currStmt = $this->dsn->prepare($query);

        if(!empty($data)) {
            $this->currStmt->execute($data);
        } else {
            $this->currStmt->execute();
        }

        return $this;
    }

    /**
     * Search for any malicious tag and block the request if found
     */
    private function sqlInjectionPreventor(array $queryCheck) {
        if(Helper::checkThisInString(";", implode("", $queryCheck)) !== false) {
            echo "Not here, suckers";
            exit;
        }
    }
}