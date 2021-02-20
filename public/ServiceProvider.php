<?php

spl_autoload_register(function($className) {
    $ds = DIRECTORY_SEPARATOR;
    $dir = __DIR__;

    $className = str_replace('\\', $ds, $className);
    $file = "{$dir}{$ds}{$className}.php";

    if(is_readable($file)) {
        require_once $file;
    }
});

// class ServiceProvider {
//     public $register;

//     public function auth() {
//         return new Auth;
//     }

//     public function csrf() {
//         return new Csrf;
//     }

//     public function request() {
//         return new Request;
//     }

//     public function session() {
//         return new Sessions;
//     }
// }