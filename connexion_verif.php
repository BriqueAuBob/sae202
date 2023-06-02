<?php

    require "lib.inc.php";

    $db = dbConnect();
    $email=$_POST['email'];
    $pwd=$_POST['pwd'];
    
    login($db, $email, $pwd);

?>
    