<?php

namespace php\misc;

use php\logic\Sessions;

Class Helper {
    /**
     * Check if defined needle exists in the string
     */
    static public function checkThisInString(string $needle, string $string) {
        return strpos($string, "$needle");
    }

    /**
     * Sanitize incoming data (NEED REVIEW)
     */
    // static public function sanitizeData(string $data) {
    //     return filter_var(strip_tags($data), FILTER_SANITIZE_STRING);
    // }

    /**
     * Redirect to homepage
     */
    static public function home($get_data = null) {
        header("Location: /");
    }

    /**
     * Redirect user to this location
     */
    static public function redirect(string $location = null) {
        header("Location: /$location");
    }

    /**
     * Build route based on dot notation
     */
    static public function route($route) {
        return "/" . str_replace(".", "/", $route);
    }

    /**
     * Generate <li> element
     */
    static public function generateLi(array $data = ["Home" => "/"]) {
        $path = "";

        foreach($data as $key => $href) {
            $key = ucwords($key);
            if($key === "Logout") {
                $path .= "<li><form method='post' action='$href'><button name='logout' type='submit'>$key</button></form></li>";
            } else {
                $path .= "<li><a href='$href'>$key</a></li>";
            }
        }

        return $path;
    }
}