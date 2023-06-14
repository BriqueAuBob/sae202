<?php
$db = dbConnect();
$query = $db->query('SELECT trips.id AS trip_id, vehicles.id AS vehicle_id, trips.*, users.*, vehicles.* FROM trips INNER JOIN users ON trips.user_id = users.id INNER JOIN vehicles ON trips.vehicle_id = vehicles.id WHERE trips.user_id = ' . $_SESSION['user']['id'] . ' ORDER BY trips.created_at DESC');
$trips = $query->fetchAll();
?>
<section class="container">
    <h1 class="mb-md center">Mes trajets</h1>
    
    <?= isset($_SESSION['message']) ? '<p>' . $_SESSION['message'] . '</p>' : '' ?>
    <?= isset($_SESSION['error']) ? '<p class="message error">' . $_SESSION['error'] . '</p>' : '' ?>

    <?php foreach ($trips as $trip) : ?>
        <div class="card big mb-sm">
            <h3><?= $trip['departure_city'] . ", " . $trip['departure_address'] ?> ---> <?= $trip['destination_city'] . ", " . $trip['destination_address'] ?></h3>
            <p><?= $trip['departure_at'] ?></p>
            <p><?= $trip['seats'] ?> places restantes</p>
            <h4>Mes passagers</h4>
            <ul>
                <?php
                $query = $db->query('
                    SELECT * FROM reservations INNER JOIN users ON reservations.user_id = users.id WHERE trip_id = ' . $trip['trip_id']);
                $reservations = $query->fetchAll();
                if (count($reservations) > 0) {
                    foreach ($reservations as $reservation) {
                        echo '<li>' . $reservation['first_name'] . ' ' . $reservation['last_name'] . '</li>';
                    }
                } else {
                    echo '<li>Vous n\'avez aucun passagers pour le moment</li>';
                }
                ?>
            </ul>
            <a class="btn red" href="../annuler_trajet.php?trip_id=<?= $trip['trip_id'] ?>">Annuler le trajet</a>
        </div>
    <?php endforeach; ?>
    <a class="btn green" href="/profil/creer_trajet.php">Créer un nouveau trajet</a>
</section>

<?php
dbDisconnect($db);
unset($_SESSION['message']);
unset($_SESSION['error']);
?>