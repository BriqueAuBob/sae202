<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require 'inc/lib.inc.php';
        $db = dbConnect();

        if(empty($_POST['lastname']) || empty($_POST['firstname']) || empty($_POST['email'])) {
            $_SESSION['error'] = "Merci de remplir tous les champs";
            header('Location: profil.php');
            die();
        }

        $id = $_SESSION['user_id'];
        $last_name = ucwords(strtolower(htmlspecialchars($_POST['lastname'])));
        $first_name = ucwords(strtolower(htmlspecialchars($_POST['firstname'])));

        $email = htmlspecialchars($_POST['email']);

        if(!($_POST['password'] == '')) {
            $password = htmlspecialchars($_POST['password']);
            if(strlen($password) < 8) {
                echo "Le mot de passe doit contenir au moins 8 caractères";
                header('Location: profil.php');
                die();
            }
        }

        $query = $db -> prepare('UPDATE users SET last_name = :last_name, first_name = :first_name, email = :email' . (isset($password) ? ', password = :password' : '') . ' WHERE id = :id');
        $query -> bindValue(':last_name', $last_name);
        $query -> bindValue(':first_name', $first_name);
        $query -> bindValue(':email', $email);
        if(isset($password)) {
            $query -> bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
        }
        $query -> bindValue(':id', $id);
        $query -> execute();

        $_SESSION['user'] = [
            'name' => $last_name,
            'firstname' => $first_name,
            'email' => $email
        ];

        $brand = (isset($_POST['brand'])) ? htmlspecialchars($_POST['brand']) : '';
        $model = (isset($_POST['model'])) ? htmlspecialchars($_POST['model']) : '';
        $color = (isset($_POST['color'])) ? htmlspecialchars($_POST['color']) : '';
        $seats = (isset($_POST['seats'])) ? htmlspecialchars($_POST['seats']) : '';

        $query = $db -> prepare('SELECT * FROM vehicles WHERE user_id = '. $id);
        $query -> execute();
        
        if($query -> rowCount() > 0) {
            $query = $db -> prepare('UPDATE vehicles SET brand = :brand, model = :model, color = :color, places = :places WHERE user_id = :user_id');
            $query -> execute([
                ':brand' => $brand,
                ':model' => $model,
                ':color' => $color,
                ':places' => $seats,
                ':user_id' => $id
            ]);
        } else {
            $query = $db -> prepare('INSERT INTO vehicles (brand, model, color, places, user_id) VALUES (:brand, :model, :color, :places, :user_id)');
            $query -> execute([
                ':brand' => $brand,
                ':model' => $model,
                ':color' => $color,
                ':places' => (int)$seats,
                ':user_id' => $id
            ]);
        }
        
        dbDisconnect($db);

        $_SESSION['message'] = "Votre profil a bien été mis à jour";
        header('Location: profil.php');
        die();
    }
?>