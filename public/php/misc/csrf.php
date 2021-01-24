<?php

class Csrf {
    private $token;

    public function __construct() {
        $_SESSION['token'] = bin2hex(random_bytes(32));
        $this->token = $_SESSION['token'];
    }

    public function checkToken($token) {
        if($this->token == $token) {
            echo "Authenticated";
        } else {
            echo "CSRF!!!!";
        }
    }

    public function test() {
        echo "Kentut";
    }
}