<?php

namespace php\misc;

Class Facade {
    static public function checkThisInString($needle, $string) {
        return strpos($string, "$needle");
    }

    static public function sanitizeData($data) {
        return filter_var(strip_tags($data), FILTER_SANITIZE_STRING);
    }
}