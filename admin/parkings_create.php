<?php
    require '../inc/lib.inc.php';

    $bd = dbConnect();

    if(empty($_POST['parking_name']) || empty($_POST['area_name'])) {
        $_SESSION['crudLog'] = 'Veuillez remplir tous les champs !';
        header('Location: forms/parkings_create_form.php');
        die();
    }

    $name = htmlspecialchars($_POST['parking_name']);
    $area = htmlspecialchars($_POST['area_name']);

    $query = $bd -> prepare('INSERT INTO parkings (name, area) VALUES (:name, :area)');
    $query -> execute([
        'name' => $name,
        'area' => $area
    ]);

    $_SESSION['crudLog'] = 'Le parking a bien été ajouté !';
    header('Location: parkings_gestion.php');
    die();
?>