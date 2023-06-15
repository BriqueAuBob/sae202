<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require '../../inc/lib.inc.php';

        $bd = dbConnect();
        
        $user_id = $_POST['user_id'];
        $old_trip_id = $_POST['old_trip_id'];
        $trip_id = $_POST['trip_id'];

        $query = $bd->prepare('UPDATE reservations SET trip_id = :trip_id WHERE trip_id = :old_trip_id AND user_id = :user_id');
        $query->execute([
            'trip_id' => $trip_id,
            'old_trip_id' => $old_trip_id,
            'user_id' => $user_id
        ]);

        dbDisconnect($bd);

        $_SESSION['crudLog'] = 'La réservation a bien été modifiée !';
        header('Location: ./');
        die();
    }

    $pageTitle = "Modification réservation";
    $template = 'reservations/modify';
    require '../../layouts/crud.php';
?>