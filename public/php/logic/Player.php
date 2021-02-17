<?php

use php\database\Model;
use php\logic\Auth;

class Player extends Model {
    private $auth;
    
    public function __construct() {
        parent::__construct();
        $this->auth = new Auth;
    }

    public function createPlayer() {
        if($this->auth->check()) {
            echo "You may create new player";
        }
    }
}