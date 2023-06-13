<?php
    $db = dbConnect();
    $query = $db->query('SELECT trips.id AS trip_id, users.id AS user_id, vehicles.id AS vehicl_id, trips.*, users.*, vehicles.*, reservations.* FROM reservations INNER JOIN trips ON reservations.trip_id = trips.id INNER JOIN users ON reservations.user_id = users.id INNER JOIN vehicles ON trips.vehicle_id = vehicles.id WHERE reservations.user_id = ' . $_SESSION['user']['id']);
    
    $reservations = $query->fetchAll();
?>
<?php foreach ($reservations as $reservation) : ?>
<div>
    <h3><?= $reservation['departure_city'] . ", " . $reservation['departure_address']?> -> <?= $reservation['destination_city'] . ", " . $reservation['destination_address'] ?></h3>
    <p>Départ le <?= $reservation['departure_at'] ?></p>
    <h4>Mon conducteur</h4>
    <p><?= $reservation['first_name'] . " " . $reservation['last_name'] ?></p>
    <h4>Son bolide</h4>
    <p><?= $reservation['brand'] . " - " . $reservation['model'] ?></p>
    <p>Couleur : <?= $reservation['color'] ?></p>
    <p>Nombre de places total : <?= $reservation['places'] ?></p>
</div>
<?php endforeach; ?>
