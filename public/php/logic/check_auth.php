<?php

class Auth {
    public function check() {
        if(!$_SESSION) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    }
}