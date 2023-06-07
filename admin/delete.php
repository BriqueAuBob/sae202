<?php
    require '../inc/lib.inc.php';

    $bd = dbConnect();

    $from = $_GET['from'];
    $table = explode('_', $from)[0];

    $id = $_GET['id'];

    $query = $bd -> prepare('DELETE FROM ' . $table . ' WHERE id = :id');
    $query -> execute([
        'id' => $id
    ]);

    if($from == 'users_gestion.php') {
        $_SESSION['crudLog'] = 'L\'utilisateur n°'.$id.' a bien été supprimé !';
    }
    if($from == 'vehicles_gestion.php') {
        $_SESSION['crudLog'] = 'Le véhicule n°'.$id.' a bien été supprimé !';
    }
    

    dbDisconnect($bd);
    header('Location: ' . $from);