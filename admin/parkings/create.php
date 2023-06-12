<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require '../../inc/lib.inc.php';

    $bd = dbConnect();

    if (empty($_POST['parking_name']) || empty($_POST['adress']) || empty($_POST['location']) || empty($_POST['spaces']) || empty($_FILES['picture'])) {
        $_SESSION['crudLog'] = 'Veuillez remplir tous les champs !';
        header('Location: ./create.php');
        die();
    }

    if(strlen($_POST['parking_name']) > 50) {
        $_SESSION['crudLog'] = 'Le nom du parking ne peut pas dépasser 50 caractères !';
        header('Location: ./create.php');
        die();
    }
    $parking_name = htmlspecialchars($_POST['parking_name']);

    if(strlen($_POST['adress']) > 100) {
        $_SESSION['crudLog'] = 'L\'adresse du parking ne peut pas dépasser les 100 caractères !';
        header('Location: ./create.php');
        die();
    }
    $adress = htmlspecialchars($_POST['adress']);

    if(strlen($_POST['location']) > 500) {
        $_SESSION['crudLog'] = 'Le lien MAPS ne peut pas dépasser les 100 caractères !';
        header('Location: ./create.php');
        die();
    }
    $location = htmlspecialchars($_POST['location']);

    $spaces = (int)$_POST['spaces'];

    $picture = $_FILES['picture'];
    $name = imgCompression($picture, '../../assets/images/parkings/', './create.php');

    $query = $bd -> prepare('INSERT INTO parkings (name, address, location, spaces, picture) VALUES (:name, :address, :location, :spaces, :picture)');
    $query -> execute([
        'name' => $parking_name,
        'address' => $adress,
        'location' => $location,
        'spaces' => $spaces,
        'picture' => $name . '.webp'
    ]);

    dbDisconnect($bd);

    $_SESSION['crudLog'] = 'Le parking a bien été ajouté !';
    header('Location: ./');
    die();
}

$pageTitle = "Ajout parking";
$template = 'parkings/create';
require '../../layouts/administration.php';
