<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require '../../inc/lib.inc.php';

        $bd = dbConnect();

        $user = $_POST['user_id'];
        $trip = $_POST['trip_id'];

        $query = $bd->prepare('INSERT INTO reservations (user_id, trip_id) VALUES (:user_id, :trip_id)');
        $query -> execute([
            ':user_id' => $user,
            ':trip_id' => $trip
        ]);

        dbDisconnect($bd);

        $_SESSION['crudLog'] = 'La réservation a bien été ajouté !';
        header('Location: ./');
        die();
    }

    $pageTitle = "Ajout réservation";
    $template = 'reservations/create';
    require '../../layouts/crud.php';
?>