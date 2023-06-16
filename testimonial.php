<?php

require './inc/lib.inc.php';

if (!isset($_SESSION['user']['id'])) {
    header('Location: /');
    exit;
}

$db = dbConnect();

if (!isset($_POST['user_id']) || !isset($_POST['stars']) || !isset($_POST['message'])) {
    $_SESSION['message'] = "Veuillez remplir tous les champs !";
    header('Location: /profil/reservations.php');
    exit;
}

if (!is_numeric($_POST['stars'])) {
    $_SESSION['message'] = "Veuillez entrer un nombre d'étoiles valide !";
    header('Location: /profil/reservations.php');
    exit;
}

if ($_POST['stars'] < 0 || $_POST['stars'] > 5) {
    $_SESSION['message'] = "Veuillez entrer un nombre d'étoiles valide !";
    header('Location: /profil/reservations.php');
    exit;
}

$query = $db->prepare('INSERT INTO testimonials (user_id, author_id, stars, content) VALUES (:user_id, :author_id, :stars, :content)');
$query->execute([
    'user_id' => $_POST['user_id'],
    'author_id' => $_SESSION['user']['id'],
    'stars' => $_POST['stars'],
    'content' => $_POST['message']
]);

$_SESSION['message'] = "Votre avis a bien été publié !";
header('Location: /profil/reservations.php');
