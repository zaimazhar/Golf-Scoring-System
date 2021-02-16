<?php

namespace php\misc;

Class Helper {
    // Check if defined needle exists in the string
    static public function checkThisInString($needle, $string) {
        return strpos($string, "$needle");
    }

    // Sanitize the data
    static public function sanitizeData($data) {
        return filter_var(strip_tags($data), FILTER_SANITIZE_STRING);
    }

    // Redirect to homepage
    static public function home() {
        header("Location: /");
    }

    // Redirect user to this location
    static public function redirect($location) {
        header("Location: /$location");
    }
}