<?php

include_once 'connection/connection.php';

class adminsql extends pgConnection {
    private $sqlConn;
    private $getUser;
    private $insertUser;
    private $currStmt;

    public function __construct() {
        $this->sqlConn = parent::__construct();
    }

    private function theQuery(string $query, array $data = null) {
        $this->currStmt = $this->sqlConn->prepare($query);

        if(!empty($data))
            $this->currStmt->execute($data);
        else
            $this->currStmt->execute();

        return $this->currStmt;
    }

    public function getUser() {
        return $this->theQuery("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCount() {
        return $this->getUser->rowCount();
    }

    public function insertUser($name, $email, $gender) {
        $this->insertUser = $this->theQuery("INSERT INTO users (name, email, gender) VALUES (?, ?, ?)", array($name, $email, $gender));

        if($this->insertUser) {
            return true;
        } else {
            return false;
        }
    }
}