<?php
    require 'inc/lib.inc.php';

    $db = dbConnect();

    $user_id = $_SESSION['user']['id'];
    $trip_id = $_GET['trip_id'];

    $query = $db->prepare('UPDATE trips SET trips.seats = trips.seats + 1 WHERE id = :trip_id');
    $query -> execute([
        'trip_id' => $trip_id
    ]);

    $query = $db->query('SELECT reservations.user_id AS user, reservations.*, trips.user_id AS driver, trips.* FROM trips INNER JOIN reservations ON trips.id = reservations.trip_id WHERE reservations.user_id = ' . $user_id);
    $trip = $query->fetch();

    if( $trip['departure_city'] == $trip['destination_city'] ) {
        $departure = $trip['departure_address'];
        $destination = $trip['destination_address'];
    } else {
        $departure = $trip['departure_city'];
        $destination = $trip['destination_city'];
    }

    $query = $db->prepare('INSERT INTO notifications (user_id, content, type) VALUES ( :user_id, :content, :type)');
    $query->execute([
        'user_id' => $user_id,
        'content' => 'Vous avez annulé votre réservation pour le trajet ' . $departure . ' -> ' . $destination . '.',
        'type' => 2
    ]);

    $query = $db->prepare('INSERT INTO notifications (user_id, content, type) VALUES ( :user_id, :content, :type)');
    $query->execute([
        'user_id' => $trip['user_id'],
        'content' => $_SESSION['user']['firstname'] . ' a annulé sa réservation pour le trajet ' . $departure . ' -> ' . $destination . '.',
        'type' => 1
    ]);

    $query = $db->prepare('DELETE FROM reservations WHERE user_id = :user_id AND trip_id = :trip_id');
    $query -> execute([
        'user_id' => $user_id,
        'trip_id' => $trip_id
    ]);

    dbDisconnect($db);
    $_SESSION['message'] = 'Votre réservation a bien été annulée !';
    header('Location: profil/reservations.php');
    die();

?>