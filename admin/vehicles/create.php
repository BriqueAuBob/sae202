<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require '../../inc/lib.inc.php';

        $bd = dbConnect();

        if(empty($_POST['brand']) || empty($_POST['model']) || empty($_POST['seats']) || empty($_POST['color']) || empty($_POST['user'])) {
            $_SESSION['crudLog'] = 'Veuillez remplir tous les champs !';
            header('Location: ./create.php');
            die();
        }

        if(strlen($_POST['brand']) > 50 || strlen($_POST['model']) > 50) {
            $_SESSION['crudLog'] = 'Merci de ne pas dépasser les 50 caractères pour la marque et le modèle du véhicule';
            header('Location: ./create.php');
            die();
        }
        $brand = htmlspecialchars($_POST['brand']);
        $model = htmlspecialchars($_POST['model']);

        if((int)$_POST['seats'] < 1 || (int)$_POST['seats'] > 99) {
            $_SESSION['crudLog'] = 'Votre véhicule doit avoir entre 1 et 99 places';
            header('Location: ./create.php');
            die();
        }
        $seats = (int)$_POST['seats'];

        if(strlen($_POST['color']) > 20) {
            $_SESSION['crudLog'] = 'Merci de ne pas dépasser les 20 caractères pour la couleur du véhicule';
            header('Location: ./create.php');
            die();
        }
        $color = htmlspecialchars($_POST['color']);

        $user = (int)$_POST['user'];

        if(isset($_FILES['picture'])) {
            $picture = $_FILES['picture'];
            $name = imgCompression($picture, '../../assets/images/vehicles/', './create.php');
        }

        $query = $bd -> prepare('INSERT INTO vehicles (brand, model, places, color, image, user_id) VALUES (:brand, :model, :seats, :color, :picture, :user_id)');
        $query -> bindValue(':brand', $brand);
        $query -> bindValue(':model', $model);
        $query -> bindValue(':seats', $seats);
        $query -> bindValue(':color', $color);
        if(isset($_FILES['picture'])) {
            $query -> bindValue(':picture', $name . '.webp');
        } else {
            $query -> bindValue(':picture', 'default.webp');
        }
        $query -> bindValue(':user_id', $user);
        $query -> execute();

        dbDisconnect($bd);

        $_SESSION['crudLog'] = 'Le véhicule a bien été ajouté !';
        header('Location: ./');
        die();
    }

    $pageTitle = "Ajout véhicule";
    $template = 'vehicles/create';
    require '../../layouts/crud.php';
?>