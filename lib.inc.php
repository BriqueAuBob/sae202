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

    function register($db, $login, $password) {
        $query = $db->prepare('INSERT INTO users(last_name, first_name, email, password, created_at) VALUES(:last_name, :first_name, :email, :password, NOW())');
        $query->execute(array(
            'last_name' => $last_name,
            'first_name' => $first_name,
            'email' => $email

        ));
    }
?>