<?php

class csrf {
    private $token;
    
    public static function generateToken() {
        $_SESSION['token'] = bin2hex(random_bytes(32));
        $this->token = $_SESSION['token'];
    }

    public static function checkToken($token) {
        if($this->token == $token) {
            echo "Authenticated";
        } else {
            echo "CSRF!!!!";
        }
    }
}