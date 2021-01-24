<?php

class Admin extends Model {
    
    private $getUser;
    private $insertUser;

    // public function getUser() {
    //     return $this->executeQuery("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
    // }

    // public function getCount() {
    //     return $this->getUser->rowCount();
    // }

    // public function insertUser($name, $email, $gender) {
    //     $this->insertUser = $this->executeQuery("INSERT INTO users (name, email, gender) VALUES (?, ?, ?)", array($name, $email, $gender));

    //     if($this->insertUser) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
}