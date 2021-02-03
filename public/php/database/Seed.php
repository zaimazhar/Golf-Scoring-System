<?php

namespace php\database;

class Seed extends Model {

    protected $sqlConn;

    public function __construct() {
        $this->sqlConn = parent::__construct();
    }

    public function SeedAdmin() {
        $this->create("new_user", array(
            "name" => "Aisyah",
            "age" => 23
        ));
    }

    public function staticTry() {
        $this::where([['id', '=', 2], ['name', '=', 'devzaim']])->get();
    }
}