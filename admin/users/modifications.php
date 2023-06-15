<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require '../../inc/lib.inc.php';

    $bd = dbConnect();
    $id = $_POST['id'];

    if (empty($_POST['id']) || empty($_POST['last_name']) || empty($_POST['first_name']) || empty($_POST['email']) || empty($_POST['created_at'])) {
        $_SESSION['crudLog'] = 'Veuillez remplir tous les champs !';
        header('Location: ./modifications.php');
        die();
    }

    $id = htmlspecialchars($_POST['id']);

    if(strlen($_POST['last_name']) > 50 || strlen($_POST['first_name']) > 50) {
        $_SESSION['crudLog'] = 'Le nom et le prénom ne peuvent pas dépasser 50 caractères !';
        header('Location: ./modifications.php');
        die();
    }
    $last_name = htmlspecialchars($_POST['last_name']);
    $first_name = htmlspecialchars($_POST['first_name']);


    if(isset($_FILES['picture'])) {
        $picture = $_FILES['picture'];
        $name = imgCompression($picture, '../../assets/images/vehicles/', './modifications.php');
    }

    if(!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
        $_SESSION['crudLog'] = 'L\'email n\'est pas valide !';
        header('Location: ./create.php');
        die();
    }
    $email = htmlspecialchars($_POST['email']);

    if(!empty($_POST['password'])) {
        if(strlen($_POST['password']) < 8 || strlen($_POST['password']) > 255) {
            $_SESSION['crudLog'] = 'Le mot de passe doit contenir entre 8 et 255 caractères';
            header('Location: ./create.php');
            die();
        }
        $password = htmlspecialchars($_POST['password']);
    }

    $created_at = htmlspecialchars($_POST['created_at']);

    $name = imgCompression($picture, '../../assets/images/avatars/', './modifications.php');

    $query = $bd->prepare('UPDATE users SET last_name = :last_name, first_name = :first_name' . (isset($_FILES['picture']) ? ', picture = :picture' : '') . ', email = :email' . (isset($password) ? ', password = :password' : '') . ', created_at = :created_at WHERE id = :id');
    $query->bindValue(':id', $id);
    $query->bindValue(':last_name', $last_name);
    $query->bindValue(':first_name', $first_name);
    if(isset($_FILES['picture'])) {
        $query -> bindValue(':picture', $name . '.webp');
    }
    $query->bindValue(':email', $email);
    if(isset($password)) {
        $query->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
    }
    $query->bindValue(':created_at', $created_at);
    $query->execute();

    $_SESSION['crudLog'] = 'L\'utilisateur a bien été modifié !';
    header('Location: ./index.php');
    die();
}

$pageTitle = "Modification utilisateur";
$template = 'users/modify';
require '../../layouts/administration.php';
