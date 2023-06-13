<?php
    $db = dbConnect();
    $query = $db->query('SELECT * FROM reservations INNER JOIN trips ON trips.id = trip_id INNER JOIN users ON users.id = trips.user_id INNER JOIN vehicles ON vehicles.id = trips.vehicle_id WHERE reservations.user_id = ' . $_SESSION['user']['id']);
    
    $reservations = $query->fetchAll();
    $acc = 0;
?>
<?php foreach ($reservations as $reservation) : ?>
    <?php $acc += 1; ?>
<div>
    <h3><?= $reservation['departure_city'] . ", " . $reservation['departure_address']?> -> <?= $reservation['destination_city'] . ", " . $reservation['destination_address'] ?></h3>
    <p>Départ le <?= $reservation['departure_at'] ?></p>
    <h4>Mon conducteur</h4>
    <p><?= $reservation['first_name'] . " " . $reservation['last_name'] ?></p>
    <h4>Son bolide</h4>
    <p><?= $reservation['brand'] . " - " . $reservation['model'] ?></p>
    <p>Couleur : <?= $reservation['color'] ?></p>
    <p>Nombre de places total : <?= (int)$reservation['places'] + $acc ?></p>
</div>
<?php endforeach; ?>
