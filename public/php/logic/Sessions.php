<?php

namespace php\logic;

class Sessions {
    /**
     * Start the session
     * */ 
    static public function start() {
        session_start();
    }

    /**
     * Close session (NEED REVIEW)
     */
    // static public function close() {
    //     session_write_close();
    // }

    /**
     * Flash the value of the session
     * 
     * param $name string
     */
    static public function old($name) {
        if(self::check(PHP_SESSION_NONE))
            self::start();
        
        if(isset($_SESSION[$name])) {
            echo $_SESSION[$name];
            unset($_SESSION[$name]);
        }
    }

    /**
     * Set a session
     * 
     * param $name string
     * param $data any
     */
    static public function setSession(string $name, $data) {
        self::start();
        $_SESSION[$name] = $data;
    }

    /**
     * Check session with given status to check
     * 
     * param $type string
     */
    static public function check($type) {
        return session_status() === $type;
    }
}