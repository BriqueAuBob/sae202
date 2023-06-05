<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'inc/lib.inc.php';

    $db = dbConnect();
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    register($db, $last_name, $first_name, $email, $password);
    die();
}

$template = 'forms/register';
$pageTitle = "Inscription";
require 'layouts/auth.php';
