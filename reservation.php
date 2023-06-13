<?php
    require 'inc/lib.inc.php';

    $db = dbConnect();

    $trip_id = $_GET['trip_id'];
    $user_id = $_SESSION['user']['id'];

    $query = $db->prepare('INSERT INTO reservations (user_id, trip_id) VALUES (:user_id, :trip_id)');
    $query -> execute([
        'user_id' => $user_id,
        'trip_id' => $trip_id
    ]);

    $query = $db->prepare('UPDATE trips SET seats = seats - 1 WHERE id = :trip_id');
    $query -> execute([
        'trip_id' => $trip_id
    ]);

    dbDisconnect($db);
    $_SESSION['message'] = 'Votre réservation a bien été prise en compte !';
    header('Location: trajets.php')
?>