<?php

namespace php\logic;

use php\logic\Auth;
use php\database\Model;

class Compute extends Model {
    private $auth;
    
    public function __construct() {
        $this->auth = new Auth;
        parent::__construct();
    }

    public function computeScore() {
        
    }
}