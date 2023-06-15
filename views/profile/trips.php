<?php
$db = dbConnect();
$query = $db->query('SELECT trips.id AS trip_id, vehicles.id AS vehicle_id, trips.*, users.*, vehicles.* FROM trips INNER JOIN users ON trips.user_id = users.id INNER JOIN vehicles ON trips.vehicle_id = vehicles.id WHERE trips.user_id = ' . $_SESSION['user']['id'] . ' ORDER BY trips.created_at DESC');
$trips = $query->fetchAll();
?>
<section class="container flex-center">
    <h1 class="mb-md center">Mes trajets</h1>

    <?= isset($_SESSION['message']) ? '<p>' . $_SESSION['message'] . '</p>' : '' ?>
    <?= isset($_SESSION['tripLog']) ? '<p class="message error">' . $_SESSION['tripLog'] . '</p>' : '' ?>

    <?php

    if ($query->rowCount() == 0) {
        echo '<p class="center">Vous n\'avez aucun trajet prévu pour le moment.</p>';
    } else {
        foreach ($trips as $trip) :
    ?>
            <?php if (strtotime($trip['arrival_at']) > strtotime(date('Y-m-d H:i:s'))) : ?>
                <div class="card big mb-sm">
                    <h3><?= $trip['departure_address'] . ", " . $trip['departure_city'] ?> ---> <?= $trip['destination_address'] . ", " . $trip['destination_city'] ?> (<?= $trip['distance'] ?> km)</h3>
                    <?php
                    if (implode(" ", array_slice(explode(" ", $trip['departure_address']), 0, 2)) == "Parking IUT") {
                        echo '<a href="../parkings.php">Trouver le parking</a>';
                    }
                    ?>
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
            <?php endif; ?>
    <?php endforeach;
    } ?>
    <a class="btn green center mt-md" href="/profil/creer_trajet.php">Créer un nouveau trajet</a>
</section>
<section class="container">
    <h2 class="center">Historique</h2>
    <?php
    foreach ($trips as $trip) : ?>
        <?php if (strtotime($trip['arrival_at']) < strtotime(date('Y-m-d H:i:s'))) : ?>
            <div class="card big mb-sm">
                <h3><?= $trip['departure_address'] . ", " . $trip['departure_city'] ?> ---> <?= $trip['destination_address'] . ", " . $trip['destination_city'] ?></h3>
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
                    }
                    ?>
                </ul>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</section>

<?php
dbDisconnect($db);
unset($_SESSION['message']);
unset($_SESSION['tripLog']);
?>