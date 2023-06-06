<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'inc/lib.inc.php';

    $db = dbConnect();

    if(empty($_POST['last_name']) || empty($_POST['first_name']) || empty($_POST['email']) || empty($_POST['password'])) {
        $_SESSION['error'] = "Merci de remplir tous les champs";
        header('Location: inscription.php');
        die();
    }

    $last_name = ucwords(strtolower(htmlspecialchars($_POST['last_name'])));
    $first_name = ucwords(strtolower(htmlspecialchars($_POST['first_name'])));


    $email = htmlspecialchars($_POST['email']);
    $query = $db -> prepare('SELECT * FROM users WHERE email = :email');
    $query -> bindValue(':email', $email, PDO::PARAM_STR);
    $query -> execute();
    $user = $query -> fetch();
    if($user) {
        $_SESSION['error'] = "Cet email est déjà utilisé";
        header('Location: inscription.php');
        die();
    }

    $password = htmlspecialchars($_POST['password']);
    if(strlen($password) < 8) {
        $_SESSION['error'] = "Le mot de passe doit contenir au moins 8 caractères";
        header('Location: inscription.php');
        die();
    }
    
    register($db, $last_name, $first_name, $email, $password);
    die();
}

$template = 'forms/register';
$pageTitle = "Inscription";
require 'layouts/auth.php';