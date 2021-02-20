<?php

use php\logic\Auth;

class Player {
    private $auth;
    
    public function __construct() {
        $this->auth = new Auth;
    }

    public function createPlayer() {
        if($this->auth->check()) {
            echo "You may create new player";
        }
    }
}