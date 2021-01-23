<?php

include "php/logic/Auth.php";
include "php/misc/Csrf.php";
include "php/logic/Request.php";
include "php/logic/Sessions.php";

class ServiceProvider {
    public $register;

    public function auth() {
        return new Auth;
    }

    public function csrf() {
        return new Csrf;
    }

    public function request() {
        return new Request;
    }

    public function session() {
        return new Sessions;
    }
}