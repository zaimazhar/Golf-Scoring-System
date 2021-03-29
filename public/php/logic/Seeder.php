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
            "user_name" => "devzaim",
            "user_password" => password_hash("zaimpassword", PASSWORD_BCRYPT),
            "user_permission" => "superadmin"
        ));
    }
}