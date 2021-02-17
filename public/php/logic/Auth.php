<?php

namespace php\logic;

use php\database\Model;
use php\misc\Helper;

class Auth extends Model {
    private $user;
    private $auth;

    /**
     * Construct the class
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Start the session
     */
    public function start() {
        session_start();
    }

    /**
     * Check if the current user is authenticated
     */
    public function check() {
        if(!$_SESSION['id']) {
            $_SESSION['error'] = "You are not logged in!";
            Helper::home();
        } else {
            return true;
        }
    }

    /**
     * Check if the user is authenticated with the correct privilege
     */
    public function checkPrivilege($privilege) {
        if($_SESSION['permission'] === $privilege) {
            $_SESSION['error'] = "You are not allowed to access the page.";
            Helper::home();
        } else {
            return true;
        }
    }

    /**
     * Navigation bar display based on current user status
     */
    public function LoginHome() {
        if($this->user()) {
            $route = Helper::route("compute.compute");
            $logout = Helper::route("posts.user_logout");
            echo "<a href='$route'>Dashboard</a><a><form action='$logout' method='post'><button name='logout' type='submit'>Logout</button></form></a>";
        } else {
            echo "<a href='/login'>Login</a>";
        }
    }

    /**
     * Logout the current authenticated user
     */
    public function logout() {
        if(Sessions::check(PHP_SESSION_NONE)) {
            $this->start();
        }

        session_unset();
        session_destroy();

        if(Sessions::check(PHP_SESSION_NONE)) {
            Helper::home();
        } else {
            return false;
        }
    }

    /**
     * Return current authenticated user id
     */
    public function id() {
        return $_SESSION['id'];
    }

    /**
     * Return current user permission
     */
    public function permission() {
        return $_SESSION['permission'];
    }

    /**
     * Check for authenticated user BUT not redirecting them
     */
    public function user() {
        return isset($_SESSION['id']);
    }

    /**
     * Attempt login
     * 
     * param $data array
     */
    public function Attempt(array $data) {
        $this->user = $this->select("new_user", null, array("user_email" => $data[0]))->get();
        if(password_verify($data[1], $this->user['user_password'])) {
            $this->start();
            $_SESSION['id'] = $this->user['id'];
            $_SESSION['permission'] = $this->user['user_permission'];
            Helper::redirect("organizer_dashboard");
        } else {
            echo "Nope";
        }
    }
}