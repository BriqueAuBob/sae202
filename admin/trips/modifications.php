<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require '../../inc/lib.inc.php';

    $bd = dbConnect();
    $id = $_POST['id'];

    if(empty($_POST['dep_city']) || empty($_POST['dep_at']) || empty($_POST['des_city']) || empty($_POST['seats'])) {
        $_SESSION['crudLog'] = 'Veuillez remplir tous les champs obligatoires !';
        header('Location: ./create.php');
        die();
    }

    if(strlen($_POST['dep_city']) > 50 || strlen($_POST['des_city']) > 50) {
        $_SESSION['crudLog'] = 'Merci de ne pas dépasser les 50 caractères pour le nom des villes.';
        header('Location: ./create.php');
        die();
    }
    $dep_city = htmlspecialchars(ucwords(strtolower($_POST['dep_city'])));
    $des_city = htmlspecialchars(ucwords(strtolower($_POST['des_city'])));

    if(strlen($_POST['dep_address']) > 100 || strlen($_POST['dep_address']) > 100) {
        $_SESSION['crudLog'] = 'Merci de ne pas dépasser les 100 caractères pour les adresses.';
        header('Location: ./create.php');
        die();
    }
    $dep_address = htmlspecialchars(ucwords(strtolower($_POST['dep_address'])));
    $des_address = htmlspecialchars(ucwords(strtolower($_POST['des_address'])));

    if((int)$_POST['seats'] < 1 || (int)$_POST['seats'] > 99) {
        $_SESSION['crudLog'] = 'Votre véhicule doit avoir entre 1 et 99 places';
        header('Location: ./create.php');
        die();
    }
    $seats = (int)$_POST['seats'];

    $dep_at = $_POST['dep_at'];  

    if (!empty($dep_address) && !empty($des_address)) {
        $distance = distance($dep_address . ", " . $dep_city, $des_address . ", " . $des_city);
        $tps = timeDistance($dep_address . ", " . $dep_city, $des_address . ", " . $des_city);
        $arr_at = date('Y-m-d H:i', strtotime("$dep_at + $tps"));
    } elseif (!empty($dep_address) && empty($des_address)) {
        $distance = distance($dep_address . ", " . $dep_city, $des_city);
        $tps = timeDistance($dep_address . ", " . $dep_city, $des_city);
        $arr_at = date('Y-m-d H:i', strtotime("$dep_at + $tps"));
    } elseif (empty($dep_address) && !empty($des_address)) {
        $distance = distance($dep_address, $des_address . ", " . $des_city);
        $tps = timeDistance($dep_address, $des_address . ", " . $des_city);
        $arr_at = date('Y-m-d H:i', strtotime("$dep_at + $tps"));
    } else {
        $distance = distance($dep_city, $des_city);
        $tps = timeDistance($dep_city, $des_city);
        $arr_at = date('Y-m-d H:i', strtotime("$dep_at + $tps"));
    }

    $user_id = $_POST['driver'];

    $query = $bd -> prepare('UPDATE trips SET departure_city = :dep_city, departure_address = :dep_address, destination_city = :des_city, destination_address = :des_address, departure_at = :dep_at, arrival_at = :arr_at, distance = :distance, seats = :seats, user_id = :user_id WHERE id = :id');
    $query -> execute([
        'dep_city' => $dep_city,
        'dep_address' => $dep_address,
        'des_city' => $des_city,
        'des_address' => $des_address,
        'dep_at' => $dep_at,
        'arr_at' => $arr_at,
        'distance' => $distance,
        'seats' => $seats,
        'user_id' => $user_id,
        'id' => $id
    ]);

    $vehicle = $query -> fetch();


    $_SESSION['crudLog'] = 'Le trajet a bien été modifié !';
    header('Location: ./');
    die();
}

$pageTitle = "Modification trajet";
$template = 'trips/modify';
require '../../layouts/crud.php';