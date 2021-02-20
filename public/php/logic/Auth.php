<?php

namespace php\logic;

use php\database\Model;
use php\misc\Helper;

class Auth extends Model {
    private $user;
    private $auth;
    private $time = 60;
    private $expired = false;

    /**
     * Construct the class
     */
    public function __construct() {
        parent::__construct();
        $this->start();
        if(isset($_SESSION['expire'])) 
            $this->expireSession();
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
        $this->update("new_user", [
            "name" => "devzaim",
            "email" => "zaim.azhar97@gmail.com",
            "id" => 1,
        ]);
        if($_SESSION['permission'] !== $privilege) {
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
            if($_SESSION['permission'] === "superadmin") {
                $dashboard = "organizer";
                $href = Helper::route("organizer_dashboard");
            } else {
                $dashboard = "administrator";
                $href = Helper::route("administrator_dashboard");
            }

            $href = array(
                "compute" => Helper::route("compute.compute"),
                $dashboard => $href,
                "logout" => Helper::route("posts.user_logout"),
            );
            
            echo Helper::generateLi($href);
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
            if($this->expired)
                Sessions::setSession("expired", "Logged Out. Your Session Expired.");
            
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
     */
    public function Attempt(array $data) {
        $this->user = $this->select("new_user", null, array("user_email" => $data[0]))->get();
        if(password_verify($data[1], $this->user['user_password'])) {
            $_SESSION['id'] = $this->user['id'];
            $_SESSION['name'] = $this->user['user_name'];
            $_SESSION['permission'] = $this->user['user_permission'];
            $_SESSION['expire'] = time() + $this->time;
            Helper::home();
        } else {
            echo "Nope";
        }
    }

    /**
     * Expire a session when equal or exceed the expiration time
     */
    private function expireSession() {
        if(time() >= $_SESSION['expire']) {
            $this->expired = true;
            $this->logout();
        } else {
            $_SESSION['expire'] = time() + $this->time;
        }
    }
}