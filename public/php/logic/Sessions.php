<?php

namespace php\logic;

class Sessions {
    // Start the session 
    static public function start() {
        session_start();
    }

    // Close session
    static public function close() {
        session_write_close();
    }

    // Flash the value of the session
    static public function old($name) {
        self::start();
        if(isset($_SESSION[$name])) {
            echo $_SESSION[$name];
            unset($_SESSION[$name]);
        }
        self::close();
    }

    // Set a session
    static public function setSession($name, $data) {
        self::start();
        $_SESSION[$name] = $data;
        self::close();
    }
}