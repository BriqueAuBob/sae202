<?php
    require 'inc/lib.inc.php';

    $db = dbConnect();

    $user_id = $_SESSION['user']['id'];
    $trip_id = $_GET['trip_id'];

    $query = $db->query('SELECT reservations.user_id AS user, reservations.*, trips.* FROM reservations INNER JOIN trips ON reservations.trip_id = trips.id WHERE trip_id = ' . $trip_id);
    $reservations = $query->fetchAll();
    foreach($reservations as $reservation) {
        $query = $db->prepare('INSERT INTO notifications (user_id, content, type) VALUES ( :user_id, :content, :type)');
        $query->bindValue(':user_id', $reservation['user']);
        $query->bindValue(':content', 'Le trajet ' . $reservation['departure_city'] . ' -> ' . $reservation['destination_city'] . ' a été annulé par son conducteur.');
        $query->bindValue(':type', 1);
        $query->execute();
    }

    $query = $db->query('SELECT * FROM trips WHERE id = ' . $trip_id);
    $trip = $query->fetch();

    $query = $db->prepare('INSERT INTO notifications (user_id, content, type) VALUES ( :user_id, :content, :type)');
    $query->bindValue(':user_id', $user_id);
    $query->bindValue(':content', 'Vous avez annulé le trajet ' . $trip['departure_city'] . ' -> ' . $trip['destination_city'] . '.');
    $query->bindValue(':type', '1');
    $query->execute();

    $query = $db->query('DELETE FROM trips WHERE id = ' . $trip_id);
    $query = $db->query('DELETE FROM reservations WHERE trip_id = ' . $trip_id);

    $_SESSION['message'] = "Votre trajet a bien été annulé, tous les participants ont été avertis.";
    header('Location: profil/trajets.php');
?>