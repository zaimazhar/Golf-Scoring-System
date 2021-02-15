<?php

namespace php\logic;

use php\database\Model;

class Seeder extends Model {
    protected $sqlConn;

    public function __construct() {
        $this->sqlConn = parent::__construct();
    }

    public function SeedAdmin() {
        $this->create("new_user", array(
            "name" => "Arif;",
            "age" => 25
        ));
    }

    public function staticTry() {
        $this::where([['id', '=', 2], ['name', '=', 'devzaim']])->get();
    }
}