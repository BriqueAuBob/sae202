<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require '../../inc/lib.inc.php';

    $bd = dbConnect();
    $id = $_POST['id'];

    if (empty($_POST['id']) || empty($_POST['parking_name']) || empty($_POST['address']) || empty($_POST['location']) || empty($_POST['spaces'])) {
    $_SESSION['crudLog'] = 'Veuillez remplir tous les champs !';
    header('Location: ./modifications.php');
    die();
    }

    $id = $_POST['id'];

    if(strlen($_POST['parking_name']) > 50) {
        $_SESSION['crudLog'] = 'Le nom du parking ne peut pas dépasser 50 caractères !';
        header('Location: ./modifications.php');
        die();
    }
    $parking_name = htmlspecialchars($_POST['parking_name']);

    if(strlen($_POST['address']) > 100) {
        $_SESSION['crudLog'] = 'L\'adresse du parking ne peut pas dépasser les 100 caractères !';
        header('Location: ./modifications.php');
        die();
    }
    $address = htmlspecialchars($_POST['address']);

    if(strlen($_POST['location']) > 500) {
        $_SESSION['crudLog'] = 'Le lien MAPS ne peut pas dépasser les 100 caractères !';
        header('Location: ./modifications.php');
        die();
    }
    $location = htmlspecialchars($_POST['location']);

    $spaces = (int)$_POST['spaces'];
    
    if(isset($_FILES['picture'])) {
        $picture = $_FILES['picture'];
        $name = imgCompression($picture, '../../assets/images/parkings/', './modifications.php');
    }

    $query = $bd -> prepare('UPDATE parkings SET name = :name, address = :address, location = :location, spaces = :spaces' . (isset($_FILES['picture']) ? ', picture = :picture' : '') . ' WHERE id = :id');
    $query -> bindValue(':id', $id);
    $query -> bindValue(':name', $parking_name);
    $query -> bindValue(':address', $address);
    $query -> bindValue(':location', $location);
    $query -> bindValue(':spaces', $spaces);
    if (isset($_FILES['picture'])) {
        $query -> bindValue(':picture', $name . '.webp');
    }
    $query -> execute();

    $_SESSION['crudLog'] = 'L\'utilisateur a bien été modifié !';
    header('Location: ./');
    die();
}

$pageTitle = "Modification parking";
$template = 'parkings/modify';
require '../../layouts/administration.php';