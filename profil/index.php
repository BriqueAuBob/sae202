<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require '../inc/lib.inc.php';
    $db = dbConnect();

    $query = $db->prepare('SELECT * FROM users WHERE id = ' . $_SESSION['user']['id']);
    $query->execute();

    $user = $query->fetch();

    if (empty($_POST['lastname']) || empty($_POST['firstname']) || empty($_POST['email'])) {
        $_SESSION['error'] = "Merci de remplir tous les champs obligatoires";
        header('Location: ./');
        die();
    }

    $id = $_SESSION['user']['id'];

    if (isset($_FILES['picture']) && !empty($_FILES['picture']['name'])) {
        $picture = $_FILES['picture'];
        $name = imgCompression($picture, '../assets/images/avatars/', './modifications.php');
        $_SESSION['user']['picture'] = $name . '.webp';
    }

    if (strlen($_POST['lastname']) > 50 || strlen($_POST['firstname']) > 50) {
        $_SESSION['error'] = "Votre prénom et votre nom ne peuvent pas dépasser les 50 caractères !";
        header('Location: ./');
        die();
    }
    $last_name = ucwords(strtolower(htmlspecialchars($_POST['lastname'])));
    $first_name = ucwords(strtolower(htmlspecialchars($_POST['firstname'])));

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || strlen($_POST['email']) > 100) {
        $_SESSION['error'] = "Votre email n'est pas valide !";
        header('Location: ./');
        die();
    }
    $email = htmlspecialchars($_POST['email']);

    if (!($_POST['password'] == '')) {
        if($_POST['password_confirm'] !== $_POST['password']) {
            $_SESSION['error'] = "Les mots de passe ne correspondent pas !";
            header('Location: ./');
            die();
        }
        $password = htmlspecialchars($_POST['password']);
        if (strlen($password) < 8 || strlen($password) > 255) {
            $_SESSION['error'] = "Le mot de passe doit contenir entre 8 et 255 caractères";
            header('Location: ./');
            die();
        }
    }

    $query = $db->prepare('UPDATE users SET last_name = :last_name, first_name = :first_name' . (isset($_FILES['picture']) && !empty($_FILES['picture']['name']) ? ', picture = :picture' : '') . ', email = :email' . (isset($password) ? ', password = :password' : '') . ' WHERE id = :id');
    $query->bindValue(':last_name', $last_name);
    $query->bindValue(':first_name', $first_name);
    if (isset($_FILES['picture']) && !empty($_FILES['picture']['name'])) {
        $query->bindValue(':picture', $name . '.webp');
    }
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

    if (isset($_FILES['car_picture']) && !empty($_FILES['car_picture']['name'])) {
        $car_picture = $_FILES['car_picture'];
        $cp_name = imgCompression($car_picture, '../assets/images/vehicles/', './') . ".webp";
    } else {
        $cp_name = '';
    }

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
        if ($cp_name !== '') {
            $updateColumns[] = 'image = :car_picture';
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
        if ($cp_name !== '') {
            $query->bindValue(':car_picture', $cp_name);
        }

        $query->bindValue(':user_id', $id);
        $query->execute();
    } else {
        if ($brand !== '' || $model !== '' || $color !== '' || ($seats !== '' || (int)$seats != 0) || $cp_name !== '') {
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
            $columns[] = 'image';
            $values[] = ':car_picture';

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
            if ($cp_name !== '') {
                $query->bindValue(':car_picture', $cp_name);
            } else {
                $query->bindValue(':car_picture', 'default.webp');
            }

            $query->bindValue(':user_id', $id);
            $query->execute();
        }
    }

    dbDisconnect($db);

    $_SESSION['message'] = "Votre profil a bien été mis à jour";
    header('Location: ./');
    die();
}

$template = 'profile/settings';
require '../layouts/profile.php';
