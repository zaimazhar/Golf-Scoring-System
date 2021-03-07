<?php

namespace php\logic;

use php\database\Model;
use php\logic\Auth;

class Competition extends Model {
    private $model;

    public function __construct() {
        parent::__construct();    
    }

    public function showAllCompetition() {
        return $this->all("competition")->getAll();
    }

    public function getCurrentCompetition(int $cid) {
        return $this->find("competition", $cid)->get();
    }
}