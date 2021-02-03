<?php

spl_autoload_register(function($className) {
    # Usually I would just concatenate directly to $file variable below
    # this is just for easy viewing on Stack Overflow)
    $ds = DIRECTORY_SEPARATOR;
    $dir = __DIR__;

// replace namespace separator with directory separator (prolly not required)
    $className = str_replace('\\', $ds, $className);

// get full name of file containing the required class
    $file = "{$dir}{$ds}{$className}.php";

// get file if it is readable
    if (is_readable($file)) require $file;
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