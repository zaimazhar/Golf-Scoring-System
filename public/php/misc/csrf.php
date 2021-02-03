<?php

namespace php\misc;

class Csrf {
    private $token;

    public function __construct() {
        $_SESSION['token'] = bin2hex(random_bytes(32));
    }

    public function checkToken($token) {
        if($_SESSION['token'] == $token) {
            echo "Authenticated";
        } else {
            echo "CSRF!!!!";
        }
    }

    static public function test() {
        echo "TESTING FROM CSRF";
    }
}
