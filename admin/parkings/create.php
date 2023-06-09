<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require '../../inc/lib.inc.php';

    $bd = dbConnect();

    if (empty($_POST['parking_name']) || empty($_POST['adress']) || empty($_POST['location']) || empty($_POST['spaces']) || empty($_FILES['picture'])) {
        $_SESSION['crudLog'] = 'Veuillez remplir tous les champs !';
        header('Location: ./create.php');
        die();
    }

    $parking_name = htmlspecialchars($_POST['parking_name']);
    $adress = htmlspecialchars($_POST['adress']);
    $location = htmlspecialchars($_POST['location']);
    $spaces = (int)$_POST['spaces'];
    $picture = $_FILES['picture'];

    if ($picture['name'] !== '') {
        $name = date("Y_m_d_H_i_s");
        $type = $picture['type'];
        $size = $picture['size'];

        if ($type != 'image/png' && $type != 'image/jpeg' && $type != 'image/jpg' && $type != 'image/webp') {
            $_SESSION['crudLog'] = 'Le format de l\'image n\'est pas valide !';
            header('Location: ./create.php');
            die();
        }

        if ($size > 1000000) {
            $_SESSION['crudLog'] = 'L\'image est trop lourde !';
            header('Location: ./create.php');
            die();
        }

        if ($type != 'image/webp') {
            transformToWebp(file_get_contents($picture['tmp_name']), '../../assets/images/parkings/' . $name . '.webp');
        }
    }

    $query = $bd -> prepare('INSERT INTO parkings (name, address, location, spaces, picture) VALUES (:name, :address, :location, :spaces, :picture)');
    $query -> execute([
        'name' => $parking_name,
        'address' => $adress,
        'location' => $location,
        'spaces' => $spaces,
        'picture' => $name . '.webp'
    ]);

    $_SESSION['crudLog'] = 'Le parking a bien été ajouté !';
    header('Location: ./index.php');
    die();
}

$pageTitle = "Ajout parking";
$template = 'parkings/create';
require '../../layouts/administration.php';
