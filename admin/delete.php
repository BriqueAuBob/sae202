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
    $_SESSION['crudLog'] = 'L\'utilisateur n°'.$id.' a bien été supprimé !';

    dbDisconnect($bd);
    header('Location: users_gestion.php');