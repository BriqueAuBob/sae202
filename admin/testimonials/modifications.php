<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require '../../inc/lib.inc.php';

    $bd = dbConnect();
    $id = $_POST['id'];

    if (empty($_POST['id']) || empty($_POST['stars']) || empty($_POST['type']) || empty($_POST['content']) || empty($_POST['user']) || empty($_POST['author'])) {
        $_SESSION['crudLog'] = 'Veuillez remplir tous les champs !';
        header('Location: ./modifications.php');
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

    $query = $bd->prepare('UPDATE testimonials SET stars = :stars, type = :type, content = :content, user_id = :user, author_id = :author WHERE id = :id');
    $query -> execute([
        ':id' => $id,
        ':stars' => $stars,
        ':type' => $type,
        ':content' => $content,
        ':user' => $user,
        ':author' => $author
    ]);

    $_SESSION['crudLog'] = 'L\'avis a bien été modifié !';
    header('Location: ./');
    die();
}

$pageTitle = "Modification avis";
$template = 'testimonials/modify';
require '../../layouts/crud.php';