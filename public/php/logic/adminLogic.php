<?php

include_once '../database/adminsql.php';

$adminQuery = new adminsql;

$check = $adminQuery->insertUser($_POST['nama'], $_POST['email'], $_POST['gender']);

if($check) {
    header('Location: ../../public/admin_dashboard');
} else {
    echo "Error.";
}