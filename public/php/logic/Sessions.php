<?php

class Sessions {
    public function old($name) {
        if(isset($_SESSION[$name])) {
            echo $_SESSION[$name];
            unset($_SESSION[$name]);
        }
    }
}