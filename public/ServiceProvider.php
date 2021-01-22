<?php

include "php/logic/Auth.php";
include "php/misc/Csrf.php";
include "php/logic/Sessions.php";

class ServiceProvider {
    public $register;

    public function __construct() {
        $this->register['auth'] = new Auth;
        $this->register['csrf'] = new Csrf;
        $this->register['session'] = new Sessions;
    }

    public function old($name) {
        if(isset($_SESSION[$name])) {
            echo $_SESSION[$name];
            unset($_SESSION[$name]);
        }
    }
}