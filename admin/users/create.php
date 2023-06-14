<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require '../../inc/lib.inc.php';
    
        $bd = dbConnect();
    
        if (empty($_POST['last_name'] || empty($_POST['first_name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['status']))) {
            $_SESSION['crudLog'] = 'Veuillez remplir tous les champs !';
            header('Location: ./create.php');
            die();
        }
    
        if(strlen($_POST['last_name']) > 50 || strlen($_POST['first_name']) > 50) {
            $_SESSION['crudLog'] = 'Le nom et le prénom ne peuvent pas dépasser 50 caractères !';
            header('Location: ./create.php');
            die();
        }
        $last_name = htmlspecialchars($_POST['last_name']);
        $first_name = htmlspecialchars($_POST['first_name']);

        if(!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
            $_SESSION['crudLog'] = 'L\'email n\'est pas valide !';
            header('Location: ./create.php');
            die();
        }
        if(strlen($_POST['email']) > 100) {
            $_SESSION['crudLog'] = 'L\'email ne peut pas dépasser 100 caractères !';
            header('Location: ./create.php');
            die();
        }
        $email = htmlspecialchars($_POST['email']);

        if(strlen($_POST['password']) < 8 || strlen($_POST['password']) > 255) {
            $_SESSION['crudLog'] = 'Le mot de passe doit contenir entre 8 et 255 caractères';
            header('Location: ./create.php');
            die();
        }
        $password = htmlspecialchars($_POST['password']);
        
        if(isset($_POST['picture'])) {
            $picture = $_FILES['picture'];
            imgCompression($picture, '../../assets/images/avatars/', 'create.php');
        }

        $query = $bd -> prepare('INSERT INTO users (last_name, first_name, email, password, status, picture) VALUES (:last_name, :first_name, :email, :password, :status, :picture)');
        $query -> bindValue(':last_name', $last_name);
        $query -> bindValue(':first_name', $first_name);
        $query -> bindValue(':email', $email);
        $query -> bindValue(':password', password_hash($_POST['password'], PASSWORD_DEFAULT));
        $query -> bindValue(':status', $_POST['status']);
        if(isset($_POST['picture'])) {
            $query -> bindValue(':picture', $name . '.webp');
        } else {
            $query -> bindValue(':picture', 'default.png');
        }
        $query -> execute();

        dbDisconnect($bd);
    
        $_SESSION['crudLog'] = 'L\'utilisateur a bien été ajouté !';
        header('Location: ./');
        die();
    }

    $pageTitle = "Ajout utilisateur";
    $template = 'users/create';
    require '../../layouts/administration.php';