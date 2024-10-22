<?php
require 'inc/lib.inc.php';

$db = dbConnect();

$trip_id = $_GET['trip_id'];
$user_id = $_SESSION['user']['id'];

$query = $db->prepare('SELECT * FROM reservations WHERE trip_id = :trip_id AND user_id = :user_id');
$query->execute([
    'trip_id' => $trip_id,
    'user_id' => $user_id
]);
$reservation = $query->fetch();
if ($reservation) {
    dbDisconnect($db);
    $_SESSION['message'] = 'Vous avez déjà effectué une réservation pour ce trajet !';
    header('Location: profil/reservations.php');
    die();
}

$query = $db->prepare('SELECT * FROM trips WHERE id = :trip_id');
$query->execute([
    'trip_id' => $trip_id
]);
$trip = $query->fetch();

if (!$trip) {
    dbDisconnect($db);
    $_SESSION['message'] = 'Ce trajet n\'existe pas !';
    header('Location: profil/reservations.php');
    die();
}

if ($trip['user_id'] == $user_id) {
    dbDisconnect($db);
    $_SESSION['message'] = 'Vous ne pouvez pas réserver votre propre trajet !';
    header('Location: profil/reservations.php');
    die();
}

$query = $db->prepare('SELECT COUNT(*) AS reservations FROM reservations WHERE trip_id = :trip_id AND user_id = :user_id');
$query->execute([
    'trip_id' => $trip_id,
    'user_id' => $user_id
]);
$reservations = $query->fetch()['reservations'];

if ($reservations > 0) {
    dbDisconnect($db);
    $_SESSION['message'] = 'Vous avez déjà réservé ce trajet !';
    header('Location: profil/reservations.php');
    die();
}

$query = $db->prepare('INSERT INTO reservations (user_id, trip_id) VALUES (:user_id, :trip_id)');
$query->execute([
    'user_id' => $user_id,
    'trip_id' => $trip_id
]);

$query = $db->prepare('UPDATE trips SET seats = seats - 1 WHERE id = :trip_id');
$query->execute([
    'trip_id' => $trip_id
]);

$query = $db->query('SELECT trips.user_id AS driver, reservations.*, trips.*, users.* FROM reservations INNER JOIN trips ON trips.id = trip_id INNER JOIN users ON users.id = reservations.user_id WHERE reservations.user_id = ' . $user_id);
$reservation = $query->fetch();

$query = $db->prepare('INSERT INTO notifications (user_id, content, type) VALUES ( :user_id, :content, :type)');
$query->execute([
    'user_id' => $reservation['driver'],
    'content' => 'Vous avez une nouvelle réservation de ' . $reservation['first_name'] . ' sur votre trajet du ' . $reservation['departure_city'] . ' -> ' . $reservation['destination_city'] . ' !',
    'type' => NotificationType::SUCCESS->value
]);

$query = $db->prepare('INSERT INTO messages (author_id, content, target_id) VALUES ( :author_id, :content, :target_id)');
$query->execute([
    'target_id' => $reservation['user_id'],
    'author_id' => $_SESSION['user']['id'],
    'content' => 'Salut, j\'aimerais réserver le trajet du ' . $reservation['departure_city'] . ' -> ' . $reservation['destination_city'] . ' !',
]);

dbDisconnect($db);
$_SESSION['message'] = 'Votre réservation a bien été prise en compte !';
header('Location: profil/reservations.php');
