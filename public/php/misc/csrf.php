<?php

namespace php\misc;

class Csrf {
    private $token;

    public function __construct() {
        $_SESSION['token'] = bin2hex(random_bytes(32));
        $this->token = $_SESSION['token'];
    }

    protected function checkToken($token) {
        if($this->token == $token) {
            echo "Authenticated";
        } else {
            echo "CSRF!!!!";
        }
    }

    static public function test() {
        echo "Kentut";
    }
}