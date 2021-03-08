<?php

namespace php\logic;

use php\database\Model;
use php\logic\Auth;

class Competition extends Model {
    public function __construct() {
        parent::__construct();    
    }

    public function getAllVenuePlayer(string $type, int $vid) {
        if($type === "stroke") {
            return $this->rawSQL("select p.name, s.sum, p.handicap from participant p inner join (select player_id, sum(par) from score where venue_id=? group by player_id) s on p.id=s.player_id;", [$vid])->getAll();
        } else {
            return $this->rawSQL("select p.name, s.sum, p.handicap from participant p inner join (select player_id, sum(sf_point) from score where venue_id=? group by player_id) s on p.id=s.player_id;", [$vid])->getAll();
        }
    }

    public function showAllCompetition() {
        return $this->all("competition")->getAll();
    }

    public function getCurrentCompetition(int $cid) {
        return $this->find("competition", $cid)->get();
    }
}