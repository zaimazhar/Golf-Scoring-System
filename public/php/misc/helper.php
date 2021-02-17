<?php

namespace php\misc;

Class Helper {
    /**
     * Check if defined needle exists in the string
     * 
     * param $needle string
     * param $string string
     */
    static public function checkThisInString(string $needle, string $string) {
        return strpos($string, "$needle");
    }

    /**
     * Sanitize incoming data
     * 
     * param $data string
     */
    static public function sanitizeData(string $data) {
        return filter_var(strip_tags($data), FILTER_SANITIZE_STRING);
    }

    /**
     * Redirect to homepage
     */
    static public function home() {
        header("Location: /");
    }

    /**
     * Redirect user to this location
     * 
     * param $location string null
     */
    static public function redirect(string $location = null) {
        header("Location: /$location");
    }

    /**
     * Build route based on dot notation
     * 
     * param $route string
     */
    static public function route($route) {
        return "/" . str_replace(".", "/", $route);
    }
}