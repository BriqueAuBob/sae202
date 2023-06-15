<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require '../../inc/lib.inc.php';

        $bd = dbConnect();
        $id = $_POST['id'];

        if(empty($_POST['brand']) || empty($_POST['model']) || empty($_POST['seats']) || empty($_POST['color']) || empty($_POST['user'])) {
            $_SESSION['crudLog'] = 'Veuillez remplir tous les champs !';
            header('Location: ./modifications.php?id=' . $id);
            die();
        }

        if(strlen($_POST['brand']) > 50 || strlen($_POST['model']) > 50) {
            $_SESSION['crudLog'] = 'Merci de ne pas dépasser les 50 caractères pour la marque et le modèle du véhicule';
            header('Location: ./modifications.php?id=' . $id);
            die();
        }
        $brand = htmlspecialchars($_POST['brand']);
        $model = htmlspecialchars($_POST['model']);
        
        if((int)$_POST['seats'] < 1 || (int)$_POST['seats'] > 99) {
            $_SESSION['crudLog'] = 'Votre véhicule doit avoir entre 1 et 99 places';
            header('Location: ./modifications.php?id=' . $id);
            die();
        }
        $seats = (int)$_POST['seats'];
        
        if(strlen($_POST['color']) > 20) {
            $_SESSION['crudLog'] = 'Merci de ne pas dépasser les 20 caractères pour la couleur du véhicule';
            header('Location: ./modifications.php?id=' . $id);
            die();
        }
        $color = htmlspecialchars($_POST['color']);

        if(isset($_FILES['picture'])) {
            $picture = $_FILES['picture'];
            $name = imgCompression($picture, '../../assets/images/vehicles/', './modifications.php');
        }

        $user = (int)$_POST['user'];


        
        $query = $bd->prepare('UPDATE vehicles SET brand = :brand, model = :model, places = :seats, color = :color, image = :picture, user_id = :user_id WHERE id = :id');
        $query->bindValue(':id', $id);
        $query->bindValue(':brand', $brand);
        $query->bindValue(':model', $model);
        $query->bindValue(':seats', $seats);
        $query->bindValue(':color', $color);
        if(isset($_FILES['picture'])) {
            $query->bindValue(':picture', $name . '.webp');
        } else {
            $query->bindValue(':picture', 'default.webp');
        }
        $query->bindValue(':user_id', $user);
        $query->execute();

        dbDisconnect($bd);

        $_SESSION['crudLog'] = 'Le véhicule n°' . $id . ' a bien été modifié !';
        header('Location: ./');
        die();
    }

    $pageTitle = "Modification véhicule";
    $template = 'vehicles/modify';
    require '../../layouts/crud.php';
?>