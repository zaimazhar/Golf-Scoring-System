<?php

namespace php\database;

use php\database\connection\pgConnection;
use php\misc\Helper;
use PDO;

class Model extends pgConnection {
    private $currStmt;
    private $currQuery;
    private $data = [];
    private $count = [];

    /**
     * Initialize the database connection
     */
    protected function __construct() {
        parent::__construct();
    }

    /**
     * Create new data
     */
    public function create(string $db, array $datas) {
        $placeholder = "?,";
        $col = implode(",", array_keys($datas));
        $placeholder = substr(str_repeat($placeholder, count($datas)), 0, -1);

        $this->currQuery = "INSERT INTO $db ($col) VALUES ($placeholder)";

        return $this->executeQuery($this->currQuery, array_values($datas));
    }

    /**
     * Create multiple new data
     */
    public function createMultiple(string $db, array $columns, array $datas) {
        $col = implode(",", $columns);

        for($i = 0; $i < count($columns); $i++) {
            array_push($this->count, "?");
        }

        $cb = function($val) {
            return  "(" . implode(",", array_replace_recursive($val, $this->count)) . ")";
        };

        $values = implode(",", array_map($cb, $datas));
        $value = array_values($datas);
        $this->currQuery = "INSERT INTO $db ($col) VALUES $values";

        $value = array_merge(...$value);

        return $this->executeQuery($this->currQuery, $value);
    }

    /**
     * WHERE clause (NEEDS REVIEW)
     */
    // public function where(array $checks) {        
    //     $this->executeQuery("SELECT ", )
    // }

    /**
     * GET all data after querying
     */
    public function getAll() {
        return $this->currStmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * GET this single data after querying
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
        if(!array_key_exists("id", $datas)) return false;

        $filterId = array_filter($datas, function($id) {
            return $id === "id";
        }, ARRAY_FILTER_USE_KEY);

        $filteredArr = array_diff_key($datas, $filterId);
        $col = implode(",", array_map(function($key, $val) {
            return "$key='$val'";
        }, array_keys($filteredArr), array_values($filteredArr)));

        return $this->executeQuery("UPDATE $table SET $col WHERE id=?", array_values($filterId));
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
    public function select(string $table, array $cols = null, array $wheres, string $order = null) {
        $cb = function($val) {
            return "$val=? AND ";
        };

        $cols = $cols ? implode(",", $cols) : "*";
        $col_check = substr(implode("", array_map($cb, array_keys($wheres))), 0, -5);

        if($order == null) {
            return $this->executeQuery("SELECT $cols FROM $table WHERE " . $col_check, array_values($wheres));
        } else {
            return $this->executeQuery("SELECT $cols FROM $table WHERE " . $col_check . " ORDER BY $order", array_values($wheres));
        }
    }

    /**
     * Count the query
     */
    public function count() {
        return $this->currStmt->rowCount();
    }

    /**
     * Return the query in order
     */
    public function orderBy() {
        return $this->currStmt->orderBy;
    }

    /**
     * Optimize current query
     */
    private function optimizeQuery() {
        
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

    protected function rawSQL(string $query, array $data) {
        return $this->executeQuery($query, $data);
    }
}