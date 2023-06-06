<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'inc/lib.inc.php';

    $db = dbConnect();

    if(empty($_POST['email']) || empty($_POST['password'])) {
        $_SESSION['error'] = "Merci de remplir tous les champs";
        header('Location: connexion.php');
        die();
    }

    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    login($db, $email, $password);
    die();
}

$template = 'forms/login';
$pageTitle = "Connexion";
require 'layouts/auth.php';
