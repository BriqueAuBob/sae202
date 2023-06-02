<?php
    require 'inc/secret.php';

    session_start();

    function dbConnect() {
        $db = null;
        try {
            $db = new PDO('mysql:host=localhost;dbname=sae202;charset=utf8', DB_USER, DB_PASSWORD);
            $db -> query("SET NAMES UTF8");
        } catch (Exception $e) {
            echo '<p>Erreur : ' . $e->getMessage() . '</p>';
            die();
        }        
        
        return $db;
    }

    function dbDisconnect($db) {
        $db = null;
    }

    function register($db, $last_name, $first_name, $email, $password) {
        $req = 'SELECT * FROM users WHERE email LIKE "'.$email.'"';
        $query = $db -> query($req);

        if ($query -> rowCount() > 0) {
            $_SESSION['error'] = 'Cet adresse mail est déjà utilisé';
            header('Location: inscription.php');
        } else {
            $query = $db -> prepare('INSERT INTO users(last_name, first_name, profile_pic, email, password, created_at) VALUES(:last_name, :first_name, :profile_pic, :email, :password, NOW())');
            $query -> execute(array(
                'last_name' => $last_name,
                'first_name' => $first_name,
                'profile_pic' => 'default.png',
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ));

            $_SESSION['message'] = 'Votre compte a bien été créé !';
            
            $user = $query -> fetch();
            $_SESSION['name'] = $user['last_name'];
            $_SESSION['firstname'] = $user['first_name'];
            $_SESSION['profile_pic'] = $user['profile_pic'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['creation_date'] = $user['created_at'];

            header('Location: index.php');
        }
    }

    function login($db, $email, $password) {
        $query = $db -> prepare('SELECT * FROM users WHERE email = :email');
        $query -> execute(array(
            'email' => $email
        ));

        $user = $query -> fetch();
        if (isset($user) && password_verify($password, $user['password'])) {
            $_SESSION['name'] = $user['last_name'];
            $_SESSION['firstname'] = $user['first_name'];
            $_SESSION['profile_pic'] = $user['profile_pic'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['creation_date'] = $user['created_at'];
            header('Location: index.php');
        } else {
            $_SESSION['error'] = 'Mauvais identifiants';
            header('Location: connexion.php');
        }
        }
?>