<?php

require_once '../config/connection.php';
include("../class/user.class.php");

session_start();

if (isset($_SESSION['client_name'])) {
    header('location:../../index.php');
    exit;
} elseif (isset($_SESSION['admin_name'])) {
    header('location:dashboard.class.php');
    exit;
} elseif (isset($_SESSION['admin_name'])) {
    header('location:controlpanel.php');
    exit;
}

$msg = '';
if (isset($_POST['submit'])) {
    $user = new User($conn);

    $userName = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    $result = $user->register($userName, $email, $password);

    if (is_numeric($result)) {
        header('location: role.php?id=' . $result);
        exit;
    } else {
        $msg = $result;
    }
}

include("../index.php");
?>
