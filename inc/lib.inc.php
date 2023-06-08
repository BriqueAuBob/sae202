<?php
require 'config.inc.php';

session_start();

function dbConnect()
{
    $db = null;
    try {
        $db = new PDO('mysql:host=localhost;dbname=sae202;charset=utf8', DB_USER, DB_PASSWORD);
        $db->query("SET NAMES UTF8");
    } catch (Exception $e) {
        echo '<p>Erreur : ' . $e->getMessage() . '</p>';
        die();
    }

    return $db;
}

function dbDisconnect($db)
{
    $db = null;
}

function register($db, $last_name, $first_name, $email, $password)
{
    $req = 'SELECT * FROM users WHERE email LIKE "' . $email . '"';
    $query = $db->query($req);

    if ($query->rowCount() > 0) {
        $_SESSION['error'] = 'Cette adresse mail est déjà utilisé';
        header('Location: inscription.php');
    } else {
        $query = $db->prepare('INSERT INTO users(last_name, first_name, email, password, created_at) VALUES(:last_name, :first_name, :email, :password, NOW())');
        $query->execute(array(
            'last_name' => $last_name,
            'first_name' => $first_name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ));

        $_SESSION['message'] = 'Votre compte a bien été créé !';

        $query = $db->prepare('SELECT * FROM users WHERE email LIKE :email');
        $query->execute(array(
            'email' => $email
        ));
        $user = $query->fetch();

        $_SESSION['name'] = $user['last_name'];
        $_SESSION['firstname'] = $user['first_name'];
        $_SESSION['picture'] = $user['picture'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['creation_date'] = $user['created_at'];

        header('Location: index.php');
    }
}

function login($db, $email, $password)
{
    $query = $db->prepare('SELECT * FROM users WHERE email LIKE :email');
    $query->execute(array(
        'email' => $email
    ));

    $user = $query->fetch();
    if (isset($user) && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['last_name'];
        $_SESSION['firstname'] = $user['first_name'];
        $_SESSION['picture'] = $user['picture'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['creation_date'] = $user['created_at'];
        header('Location: index.php');
    } else {
        $_SESSION['error'] = 'Mauvais identifiants';
        header('Location: connexion.php');
    }
}

function deleteAcc($db, $email, $password)
{
    $query = $db->prepare('SELECT * FROM users WHERE email LIKE :email');
    $query->execute(array(
        'email' => $email
    ));

    $user = $query->fetch();
    if (password_verify($password, $user['password'])) {
        $query = $db->prepare('DELETE FROM users WHERE email LIKE :email');
        $query->execute(array(
            'email' => $email
        ));

        $_SESSION['message'] = 'Votre compte a bien été supprimé !';
        header('Location: index.php');
    } else {
        $_SESSION['error'] = 'Mauvais mot de passe';
        header('Location: profil.php');
    }
}


function transformToWebp($picture, $path)
{
    $jpeg = imagecreatefromstring($picture);
    $size = getimagesizefromstring($picture);
    $ratio = $size[0] / $size[1];
    if ($ratio > 1) {
        $width = 500;
        $height = 500 / $ratio;
    } else {
        $width = 500 * $ratio;
        $height = 500;
    }
    $webp = imagecreatetruecolor($width, $height);
    imagecopyresized($webp, $jpeg, 0, 0, 0, 0, $width, $height, imagesx($jpeg), imagesy($jpeg));
    imagewebp($webp, $path, 60);
}
