<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'inc/lib.inc.php';

    $db = dbConnect();

    $email = $_POST['email'];
    $password = $_POST['password'];

    login($db, $email, $password);
    die();
}

$template = 'forms/login';
require 'layouts/auth.php';
