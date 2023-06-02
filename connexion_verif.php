<?php

    require 'lib.inc.php';

    $db = dbConnect();

    $email = $_POST['email'];
    $password = $_POST['password'];
    
    login($db, $email, $password);

?>
    