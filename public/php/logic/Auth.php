<?php

namespace php\logic;

use php\database\Model;
use php\misc\Helper;

class Auth extends Model {
    private $user;

    public function __construct() {
        parent::__construct();       
    }

    public function start() {
        session_start();
    }

    // Check if the user is authenticated with the correct privilege or redirect them back to homepage
    public function check() {
        if(!$_SESSION['id']) {
            $_SESSION['error'] = "You are not logged in!";
            Helper::home();
        }
    }

    // Check if the user is authenticated with the correct privilege or redirect them back to homepage
    public function checkPrivilege($privilege) {
        if(!$_SESSION['id'] && ($_SESSION['permission'] === $privilege)) {
            $_SESSION['error'] = "Not authenticated or you are not allowed to access the page.";
            Helper::home();
        }
    }

    // Navigation bar display based on current user status
    public function LoginHome() {
        if($this->user()) {
            echo "<a href='/dashboard'>Dashboard</a>";
        } else {
            echo "<a href='/login'>Login</a>";
        }
    }

    // Check if current user is authenticated
    public function user() {
        isset($_SESSION['id']);
    }

    // Attempting to login with the current data
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