<?php

class Auth {
    static public function start() {
        session_start();
    }

    static public function check() {
        if(!$_SESSION['id']) {
            $_SESSION['error'] = "You are not logged in!";
            header("Location: /");
        }
    }

    static public function LoginHome() {
        if(Auth::user()) {
            echo "<a href='/dashboard'>Dashboard</a>";
        } else {
            echo "<a href='/login'>Login</a>";
        }
    }

    static public function user() {
        isset($_SESSION['id']);
    }
}