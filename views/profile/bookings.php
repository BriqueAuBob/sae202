<?php
$db = dbConnect();
$query = $db->query('SELECT *, users.id as trip_author_id FROM reservations INNER JOIN trips ON trips.id = trip_id INNER JOIN users ON users.id = trips.user_id INNER JOIN vehicles ON vehicles.id = trips.vehicle_id WHERE reservations.user_id = ' . $_SESSION['user']['id']);

$reservations = $query->fetchAll();
$acc = 0;
?>
<section class="container">
    <h1 class="mb-md center">Mes réservations</h1>
    <?= isset($_SESSION['message']) ? '<p>' . $_SESSION['message'] . '</p>' : '' ?>
    <?= isset($_SESSION['tripLog']) ? '<p class="message error">' . $_SESSION['tripLog'] . '</p>' : '' ?>

    <?php
    if ($query->rowCount() == 0) {
        echo '<p class="center">Vous n\'avez aucune réservation pour le moment</p>';
    } else {
        foreach ($reservations as $reservation) : ?>
            <?php $acc += 1;
            $modal = "modal_create_testimonial_{$reservation['trip_author_id']}" ?>
            <div class="card big">
                <h3><?= $reservation['departure_city'] . ", " . $reservation['departure_address'] ?> -> <?= $reservation['destination_city'] . ", " . $reservation['destination_address'] ?> (<?= $reservation['distance'] ?> km)</h3>
                <?php
                if (implode(" ", array_slice(explode(" ", $reservation['departure_address']), 0, 2)) == "Parking IUT") {
                    echo '<a href="../parkings.php">Trouver le parking</a>';
                }
                ?>
                <p>Départ le <?= $reservation['departure_at'] ?></p>
                <h4>Mon conducteur</h4>
                <p><?= $reservation['first_name'] . " " . $reservation['last_name'] ?></p>
                <h4>Son véhicule</h4>
                <p><?= $reservation['brand'] . " - " . $reservation['model'] ?></p>
                <p>Couleur : <?= $reservation['color'] ?></p>
                <p>Nombre de places total : <?= (int)$reservation['places'] + $acc ?></p>
                <img class="small" src="../assets/images/vehicles/<?= $reservation['image'] ?>" alt="<?= $reservation['brand'] . " - " . $reservation['model'] ?>">
                <div class="flex">
                    <button class="btn green" onclick="openModal('<?= $modal ?>')">Publier un avis</button>
                    <a class=" btn red" href="../annuler_reservation.php?trip_id=<?= $reservation['trip_id'] ?>">Annuler la réservation</a>
                </div>
            </div>
            <div class="modal hidden" id="<?= $modal ?>">
                <form action="/testimonial.php" method="post">
                    <div class="modal-container">
                        <main>
                            <h1>Mettre un avis à <?= $reservation['first_name'] ?></h1>
                            <input type="hidden" name="user_id" value="<?= $reservation['trip_author_id'] ?>">
                            <label class="hidden" for="stars">Nombre d'étoiles</label>
                            <input class="mt-md" type="number" min="0" max="5" name="stars" id="stars" placeholder="Nombre d'étoiles...">
                            <label class="hidden" for="message">Message</label>
                            <textarea class="mt-sm" type="text" name="message" id="message" placeholder="Votre message..."></textarea>
                        </main>
                        <footer class="btn-list">
                            <button type="button" class="btn no-margin" data-close-modal="<?= $modal ?>">Annuler</button>
                            <button type="submit" class="btn no-margin green">Publier mon avis</button>
                        </footer>
                    </div>
                </form>
            </div>
    <?php endforeach;
    } ?>
</section>

<?php
dbDisconnect($db);
unset($_SESSION['message']);
unset($_SESSION['error']);
?>