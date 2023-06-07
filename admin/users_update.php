<?php
    require '../inc/lib.inc.php';

    $bd = dbConnect();
    $id = $_POST['id'];

    if(empty($_POST['id']) || empty($_POST['last_name']) || empty($_POST['first_name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['created_at'])) {
        $_SESSION['crudLog'] = 'Veuillez remplir tous les champs !';
        header('Location: users_update_form.php');
        die();
    }

    $id = $_POST['id'];
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $picture = $_FILES['picture'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $status = $_POST['status'];
    $created_at = $_POST['created_at'];

    if($picture['name'] !== '') {
        $name = date("Y_m_d_H_i_s");
        $type = $picture['type'];
        $size = $picture['size'];

        if($type != 'image/png' && $type != 'image/jpeg' && $type != 'image/jpg' && $type != 'image/webp') {
            $_SESSION['crudLog'] = 'Le format de l\'image n\'est pas valide !';
            header('Location: users_update_form.php');
            die();
        }

        if($size > 1000000) {
            $_SESSION['crudLog'] = 'L\'image est trop lourde !';
            header('Location: users_update_form.php');
            die();
        }

        if($type != 'image/webp') {
            transformToWebp(file_get_contents($picture['tmp_name']), '../assets/images/avatars/' . $name . '.webp');
        }
    }

    $query = $bd -> prepare('UPDATE users SET last_name = :last_name, first_name = :first_name' . ($picture['name'] !== '' ? ', picture = :picture' : '') . ', email = :email, password = :password, status = :status, created_at = :created_at WHERE id = :id');
    $query -> bindValue(':id', $id);
    $query -> bindValue(':last_name', $last_name);
    $query -> bindValue(':first_name', $first_name);
    if($picture['name'] !== '') {
        $query -> bindValue(':picture', $name . '.webp');
    }
    $query -> bindValue(':email', $email);
    $query -> bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
    $query -> bindValue(':status', $status);
    $query -> bindValue(':created_at', $created_at);
    $query -> execute();

    $_SESSION['crudLog'] = 'L\'utilisateur a bien été modifié !';
    header('Location: users_gestion.php');
    die();