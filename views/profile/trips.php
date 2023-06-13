<?php
$db = dbConnect();
    $query = $db->query('SELECT trips.id AS trip_id, vehicles.id AS vehicle_id, trips.*, users.*, vehicles.* FROM trips INNER JOIN users ON trips.user_id = users.id INNER JOIN vehicles ON trips.vehicle_id = vehicles.id WHERE trips.user_id = ' . $_SESSION['user']['id'] . ' ORDER BY trips.created_at DESC');
    $trips = $query->fetchAll();
?>
<?php foreach ($trips as $trip) : ?>
    <div>
        <h3><?= $trip['departure_city'] . ", " . $trip['departure_address'] ?> -> <?= $trip['destination_city'] . ", " . $trip['destination_address'] ?></h3>
        <p><?= $trip['departure_at'] ?></p>
        <p><?= $trip['seats'] ?> places restantes</p>
        <h4>Mes passagers</h4>
        <ul>
            <?php
                $query = $db->query('SELECT * FROM reservations WHERE trip_id = ' . $trip['trip_id']);
                $reservations = $query->fetchAll();
            ?>
            <?php foreach ($reservations as $reservation) : ?>
                <?php
                    $query = $db->query('SELECT * FROM users WHERE id = ' . $reservation['user_id']);
                    $user = $query->fetch();
                ?>
                <li><?= $user['first_name'] ?> <?= $user['last_name'] ?></li>
            <?php endforeach; ?>
    </div>
<?php endforeach; ?>