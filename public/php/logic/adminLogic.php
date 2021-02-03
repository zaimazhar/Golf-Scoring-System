<?php

use php\database\Admin;

$adminQuery = new Admin;

if(!isset($_SERVER['HTTPS'])) {
    print_r(parse_url("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"));
} else {
    print_r(parse_url("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"));
}
// print_r(parse_url("http://golf_score_system.io/admin_dashboard"));
// $check = $adminQuery->insertUser($_POST['nama'], $_POST['email'], $_POST['gender']);

// if($check) {
//     header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin_dashboard');
// } else {
//     echo "Error.";
// }