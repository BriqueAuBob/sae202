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

        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['last_name'],
            'firstname' => $user['first_name'],
            'picture' => $user['picture'],
            'email' => $user['email'],
            'creation_date' => $user['created_at']
        ];

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
        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['last_name'],
            'firstname' => $user['first_name'],
            'picture' => $user['picture'],
            'email' => $user['email'],
            'creation_date' => $user['created_at']
        ];
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
    imagewebp($webp, $path, 70);
}

function imgCompression($picture, $path, $location)
{
    if ($picture['name'] !== '') {
        $name = date("Y_m_d_H_i_s");
        $type = $picture['type'];
        $size = $picture['size'];

        if ($type != 'image/png' && $type != 'image/jpeg' && $type != 'image/jpg' && $type != 'image/webp') {
            $_SESSION['crudLog'] = 'Le format de l\'image n\'est pas valide !';
            header('Location: ' . $location);
            die();
        }

        if ($size > 1000000) {
            $_SESSION['crudLog'] = 'L\'image est trop lourde !';
            header('Location:  ' . $location);
            die();
        }

        if ($type != 'image/webp') {
            transformToWebp(file_get_contents($picture['tmp_name']), $path . $name . '.webp');
        }
        
        return $name;
    }
}

function isAuthenticated()
{
    return isset($_SESSION['user']);
}

function distance($address1, $address2) {
    $addressHash1 = urlencode($address1);
    $addressHash2 = urlencode($address2);

    $url = 'https://maps.googleapis.com/maps/api/distancematrix/json?origins=' . $addressHash1 . '&destinations=' . $addressHash2 . '&key=' . KEY;

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $query = curl_exec($curl);
    if (curl_errno($curl)) {
        curl_close($curl);
        return false;
    }
    curl_close($curl);

    $data = json_decode($query, true);
    if ($data['status'] == 'OK') {
        $distance = $data['rows'][0]['elements'][0]['distance']['value'];
        $km = $distance / 1000;
        return round($km, 1);
    } else {
        return false;
    }
}
