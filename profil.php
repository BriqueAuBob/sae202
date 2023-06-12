<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'inc/lib.inc.php';
    $db = dbConnect();

    if (empty($_POST['lastname']) || empty($_POST['firstname']) || empty($_POST['email']) || !filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Merci de remplir tous les champs";
        header('Location: profil.php');
        die();
    }

    $id = $_SESSION['user']['id'];
    $last_name = ucwords(strtolower(htmlspecialchars($_POST['lastname'])));
    $first_name = ucwords(strtolower(htmlspecialchars($_POST['firstname'])));

    $email = htmlspecialchars($_POST['email']);

    if (!($_POST['password'] == '')) {
        $password = htmlspecialchars($_POST['password']);
        if (strlen($password) < 8) {
            echo "Le mot de passe doit contenir au moins 8 caractères";
            header('Location: profil.php');
            die();
        }
    }

    $query = $db->prepare('UPDATE users SET last_name = :last_name, first_name = :first_name, email = :email' . (isset($password) ? ', password = :password' : '') . ' WHERE id = :id');
    $query->bindValue(':last_name', $last_name);
    $query->bindValue(':first_name', $first_name);
    $query->bindValue(':email', $email);
    if (isset($password)) {
        $query->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
    }
    $query->bindValue(':id', $id);
    $query->execute();

    $_SESSION['user']['name'] = $last_name;
    $_SESSION['user']['firstname'] = $first_name;
    $_SESSION['user']['email'] = $email;

    $brand = (isset($_POST['brand'])) ? htmlspecialchars($_POST['brand']) : '';
    $model = (isset($_POST['model'])) ? htmlspecialchars($_POST['model']) : '';
    $color = (isset($_POST['color'])) ? htmlspecialchars($_POST['color']) : '';
    $seats = (isset($_POST['seats'])) ? htmlspecialchars($_POST['seats']) : '';

    $query = $db->prepare('SELECT * FROM vehicles WHERE user_id = ' . $id);
    $query->execute();

    if ($query->rowCount() > 0) {
        $updateColumns = [];

        if ($brand !== '') {
            $updateColumns[] = 'brand = :brand';
        }
        if ($model !== '') {
            $updateColumns[] = 'model = :model';
        }
        if ($color !== '') {
            $updateColumns[] = 'color = :color';
        }
        if ($seats !== '' || (int)$seats != 0) {
            $updateColumns[] = 'places = :places';
        }

        $query = $db->prepare('UPDATE vehicles SET ' . implode(', ', $updateColumns) . ' WHERE user_id = :user_id');

        if ($brand !== '') {
            $query->bindValue(':brand', $brand);
        }
        if ($model !== '') {
            $query->bindValue(':model', $model);
        }
        if ($color !== '') {
            $query->bindValue(':color', $color);
        }
        if ($seats !== '' || (int)$seats != 0) {
            $query->bindValue(':places', (int)$seats);
        }

        $query->bindValue(':user_id', $id);
        $query->execute();
    } else {
        if ($brand !== '' || $model !== '' || $color !== '' || ($seats !== '' || (int)$seats != 0)) {
            $columns = [];
            $values = [];

            if ($brand !== '') {
                $columns[] = 'brand';
                $values[] = ':brand';
            }
            if ($model !== '') {
                $columns[] = 'model';
                $values[] = ':model';
            }
            if ($color !== '') {
                $columns[] = 'color';
                $values[] = ':color';
            }
            if ($seats !== '' || (int)$seats != 0) {
                $columns[] = 'places';
                $values[] = ':places';
            }

            $query = $db->prepare('INSERT INTO vehicles (' . implode(', ', $columns) . ', user_id) VALUES (' . implode(', ', $values) . ', :user_id)');

            if ($brand !== '') {
                $query->bindValue(':brand', $brand);
            }
            if ($model !== '') {
                $query->bindValue(':model', $model);
            }
            if ($color !== '') {
                $query->bindValue(':color', $color);
            }
            if ($seats !== '' || (int)$seats != 0) {
                $query->bindValue(':places', (int)$seats);
            }

            $query->bindValue(':user_id', $id);
            $query->execute();
        }
    }

    dbDisconnect($db);

    $_SESSION['message'] = "Votre profil a bien été mis à jour";
    header('Location: profil.php');
    die();
}

$template = 'profile';
require 'layouts/default.php';
