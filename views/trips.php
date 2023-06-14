<header class="green small">
    <div class="container">
        <h1 class="center">Prenez un billet pour vos trajet </h1>
        <form class="form-header">
            <div>
                <label for="departure">Départ</label>
                <input type="text" name="departure" id="departure" placeholder="Départ">
            </div>
            <div>
                <label for="arrival">Arrivée</label>
                <input type="text" name="arrival" id="arrival" placeholder="Arrivée">
            </div>
            <div>
                <label for="date_hour">Date et heure</label>
                <input type="text" name="date_hour" id="date_hour" placeholder="Date et heure">
            </div>
            <button class="btn" type="submit">Rechercher</button>
        </form>
    </div>
</header>

<?= isset($_SESSION['message']) ? '<p>' . $_SESSION['message'] . '</p>' : '' ?>
<?= isset($_SESSION['tripLog']) ? '<p class="message error">' . $_SESSION['tripLog'] . '</p>' : '' ?>

<?= isset($_SESSION['user']['id']) ? '<a href="/profil/creer_trajet.php"><i class="fa-solid fa-circle-plus"></i> Nouveau trajet</a>' : '' ?>

<script src="assets/js/trip_parking.js"></script>

<section>
    <div class="container">
        <div class="grid cols-3 mt-md">
            <?php
            /* include('./components/card_trip.php');
            for ($i = 0; $i < 4; $i++) {
                cardTrip();
            } */
            $db = dbConnect();

            $query = $db->query('SELECT trips.id AS trip_id, vehicles.id AS vehicle_id, trips.*, users.*, vehicles.* FROM trips INNER JOIN users ON trips.user_id = users.id INNER JOIN vehicles ON trips.vehicle_id = vehicles.id ORDER BY trips.created_at DESC');
            $trips = $query->fetchAll();
            ?>
            <?php foreach ($trips as $trip) : ?>
                <?php if ($trip['seats'] > 0) : ?>
                    <div class="card hover dark">
                        <img class="full" src="assets/images/vehicles/<?= $trip['image'] ?>" alt="car" style="max-width: 400px;">
                        <div class="gradient"></div>
                        <div class="tags top">
                            <span><img src="./assets/images/icons/users.svg" alt="seats icon"><?= $trip['seats'] ?> places</span>
                            <span><img src="./assets/images/icons/clock.svg" alt="clock icon"><?= $trip['departure_at'] ?></span>
                            <span class="trip2"><img src="./assets/images/avatars/<?= $trip['picture'] ?>" alt="profile picture" style="width: 40px; border-radius: 50%;">
                                <p><?= $trip['first_name'] . " " . $trip['last_name'] ?></p>
                            </span>
                        </div>
                        <div class="trip">
                            <span><?= $trip['departure_city'] != $trip['destination_city'] ? $trip['departure_city'] : $trip['departure_city'] . ", " . $trip['departure_address'] ?></span>
                            <img src="./assets/images/icons/arrow-dotted.svg" alt="arrow dotted icon">
                            <span><?= $trip['departure_city'] != $trip['destination_city'] ? $trip['destination_city'] : $trip['destination_city'] . ", " . $trip['destination_address'] ?></span>
                        </div>
                        <div class="trip2">
                            <span><?= $trip['departure_city'] . ", " . $trip['departure_address'] ?></span>
                            <img src="./assets/images/icons/arrow-dotted.svg" alt="arrow dotted icon">
                            <span><?= $trip['destination_city'] . ", " . $trip['destination_address'] ?></span>
                            <?php
                                if(isAuthenticated()) {
                                    if($trip['user_id'] !== $_SESSION['user']['id']) {
                                        echo '<a href="reservation.php?trip_id=' . $trip['trip_id'] . '" class="btn">Réserver</a>';
                                    } else {
                                        echo '<a href="edit_trip.php?trip_id=' . $trip['trip_id'] . '" class="btn">Modifier</a>';
                                    }
                                }
                            ?>
                        </div>
                        <style>
                            .trip2 {
                                display: none;
                            }
                        </style>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
    <script>
        let previousCard = null;

        document.querySelectorAll('.card').forEach(card => {
            card.addEventListener('click', () => {
                if (previousCard !== null) {
                    previousCard.style.gridColumn = '';
                    previousCard.style.gridRow = '';
                    const previousTrip1 = previousCard.querySelector('.trip');
                    const previousTrip2 = previousCard.querySelectorAll('.trip2');
                    previousTrip1.style.display = '';
                    previousTrip2.forEach(trip => {
                        trip.style.display = '';
                        trip.style.alignItems = '';
                    });
                }

                card.style.gridColumn = '1 / span 3';
                card.style.gridRow = '1';

                const trip1 = card.querySelector('.trip');
                const trip2 = card.querySelectorAll('.trip2');

                trip1.style.display = 'none';
                trip2.forEach(trip => {
                    trip.style.display = 'flex';
                    trip.style.alignItems = 'center';
                });

                previousCard = card;
            });
        });
    </script>
</section>

<?php
unset($_SESSION['message']);
unset($_SESSION['tripLog']);
?>