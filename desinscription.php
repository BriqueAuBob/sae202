<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'inc/lib.inc.php';
    $bd = dbConnect();

    $email = $_SESSION['user']['email'];
    $password = $_POST['password'];

    if(empty($_SESSION['user']['email'])) {
        $_SESSION['error'] = "Merci de vous connecter pour pouvoir supprimer votre compte";
        header('Location: connexion.php');
        die();
    }

    if(empty($_POST['password'])) {
        $_SESSION['error'] = "Merci de confirmer votre mot de passe";
        header('Location: profil');
        die();
    }

    deleteAcc($bd, $email, $password);

    $_SESSION = array();
    $_SESSION['message'] = "Votre compte a bien été supprimé";
    header('Location: /');
    die();
}

