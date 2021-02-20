<?php

use php\logic\Auth;

class Competition {
    private $auth;

    public function __construct() {
        $this->auth = new Auth;
    }

    public function createCompetition(string $name) {
        if($this->auth->checkPrivilege("superadmin")) {
            
        }
    }
}