<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require '../../inc/lib.inc.php';

    $bd = dbConnect();
    $id = $_POST['id'];

    if (empty($_POST['id']) || empty($_POST['parking_name']) || empty($_POST['address']) || empty($_POST['location']) || empty($_POST['spaces'])) {
        $_SESSION['crudLog'] = 'Veuillez remplir tous les champs !';
        header('Location: users_update_form.php');
        die();
    }

    $id = $_POST['id'];
    $parking_name = $_POST['parking_name'];
    $address = $_POST['address'];
    $location = $_POST['location'];
    $spaces = $_POST['spaces'];
    $picture = $_FILES['picture'];

    if ($picture['name'] !== '') {
        $name = date("Y_m_d_H_i_s");
        $type = $picture['type'];
        $size = $picture['size'];

        if ($type != 'image/png' && $type != 'image/jpeg' && $type != 'image/jpg' && $type != 'image/webp') {
            $_SESSION['crudLog'] = 'Le format de l\'image n\'est pas valide !';
            header('Location: users_update_form.php');
            die();
        }

        if ($size > 1000000) {
            $_SESSION['crudLog'] = 'L\'image est trop lourde !';
            header('Location: users_update_form.php');
            die();
        }

        if ($type != 'image/webp') {
            transformToWebp(file_get_contents($picture['tmp_name']), '../../assets/images/parkings/' . $name . '.webp');
        }
    }

    $query = $bd -> prepare('UPDATE parkings SET name = :name, address = :address, location = :location, spaces = :spaces' . ($picture['name'] !== '' ? ', picture = :picture' : '') . ' WHERE id = :id');
    $query -> bindValue(':id', $id);
    $query -> bindValue(':name', $parking_name);
    $query -> bindValue(':address', $address);
    $query -> bindValue(':location', $location);
    $query -> bindValue(':spaces', $spaces);
    if ($picture['name'] !== '') {
        $query -> bindValue(':picture', $name . '.webp');
    }
    $query -> execute();

    $_SESSION['crudLog'] = 'L\'utilisateur a bien été modifié !';
    header('Location: ./index.php');
    die();
}

$pageTitle = "Modification parking";
$template = 'parkings/modify';
require '../../layouts/administration.php';