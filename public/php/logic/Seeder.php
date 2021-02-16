<?php

namespace php\logic;

use php\database\Model;

class Seeder extends Model {
    protected $sqlConn;
    protected $model;

    public function __construct() {
        parent::__construct();
    }

    public function SeedAdmin() {
        $this->create("new_user", array(
            "user_email" => "zaim.azhar97@gmail.com",
            "user_age" => 24,
            "user_password" => password_hash("Zaimzaim1@", PASSWORD_BCRYPT),
            "user_permission" => "superadmin"
        ));
    }

    public function staticTry() {
        $this->where([['id', '=', 2], ['name', '=', 'devzaim']])->get();
    }
}