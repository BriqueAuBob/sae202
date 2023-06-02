<?php
    require 'lib.inc.php';

    $db = dbConnect();
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $email = $_POST['email'];
    $password = $_POST['pwd'];

    register($db, $last_name, $first_name, $email, $password);
?>