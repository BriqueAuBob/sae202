<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require '../../inc/lib.inc.php';

    $bd = dbConnect();

    if (empty($_POST['stars']) || empty($_POST['type']) || empty($_POST['content']) || empty($_POST['user']) || empty($_POST['author'])) {
        $_SESSION['crudLog'] = 'Veuillez remplir tous les champs !';
        header('Location: ./create.php');
        die();
    }

    if(strlen($_POST['content']) > 70) {
        $_SESSION['crudLog'] = 'Le contenu de l\'avis ne peut pas dépasser les 70 caractères !';
        header('Location: ./create.php');
        die();
    }
    
    $stars = $_POST['stars'];
    $type = $_POST['type'];
    $content = htmlspecialchars($_POST['content']);
    $user = $_POST['user'];
    $author = $_POST['author'];

    $query = $bd->prepare('INSERT INTO testimonials (stars, type, content, user_id, author_id) VALUES (:stars, :type, :content, :user, :author)');
    $query -> execute([
        ':stars' => $stars,
        ':type' => $type,
        ':content' => $content,
        ':user' => $user,
        ':author' => $author
    ]);

    dbDisconnect($bd);

    $_SESSION['crudLog'] = 'L\'avis a bien été ajouté !';
    header('Location: ./');
    die();
}

$pageTitle = "Ajout avis";
$template = 'testimonials/create';
require '../../layouts/crud.php';