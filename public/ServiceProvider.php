<?php

spl_autoload_register(function($classname) {
    require_once "php/logic/$classname.php";
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