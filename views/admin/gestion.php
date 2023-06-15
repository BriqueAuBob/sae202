<main>
    <section style="max-width: 1600px; margin: 0 auto;">
    <div class="grid cols-3 mt-md">
        <div class="card">
            <?php
                $bd = dbConnect();

                $query = $bd -> prepare('SELECT COUNT(*) AS registered FROM users');
                $query -> execute();
                $registered = $query -> fetch()['registered'];
            ?>
            <h2>Utilisateurs</h2>
            <h3><?= $registered ?> utilisateurs</h3>
            <div class="btn-list">
                <a class="btn" href="users">Voir les utilisateurs</a>
                <a class="btn" href="users/create.php">Ajouter un utilisateur</a>
            </div>
        </div>
        <div class="card">
            <?php
                $bd = dbConnect();

                $query = $bd -> prepare('SELECT COUNT(*) AS vehicles FROM vehicles');
                $query -> execute();
                $vehicles = $query -> fetch()['vehicles'];
            ?>
            <h2>Véhicules</h2>
            <h3><?= $vehicles ?> véhicules enregistrés</h3>
            <div class="btn-list">
                <a class="btn" href="vehicles">Voir les véhicules</a>
                <a class="btn" href="vehicles/create.php">Ajouter un véhicule</a>
            </div>
        </div>
        <div class="card">
            <?php
                $query = $bd -> prepare('SELECT COUNT(*) AS trips FROM trips');
                $query -> execute();
                $trips = $query -> fetch()['trips'];

                $query = $bd->prepare('SELECT trips.id, trips.distance, reservations.user_id AS user FROM trips INNER JOIN reservations ON trips.id = reservations.trip_id WHERE reservations.trip_id = trips.id');
                $query->execute();
                $distances = $query->fetchAll();
                $d = 0;
                foreach ($distances as $distance) {
                    $query = $bd->prepare('SELECT COUNT(*) AS reservations FROM reservations WHERE trip_id =' . $distance['id']);
                    $query->execute();
                    $reservations = $query->fetch()['reservations'];
                    $d += $distance['distance'] * $reservations;
                }
            ?>
            <h2>Trajets</h2>
            <div class="btn-list">
                <h3><?= $trips ?> trajets proposés</h3>
                <h3><?= $d ?> km parcourus</h3>
                <h3><?= round($d * 0.1482, 1) ?> kg de CO2 évité</h3>
            </div>
            <div class="btn-list">
                <a class="btn" href="trips">Voir les trajets</a>
                <a class="btn" href="trips/create.php">Ajouter un trajet</a>
            </div>
        </div>
        <div class="card">
            <?php
                $query = $bd -> prepare('SELECT COUNT(*) AS reservations FROM reservations');
                $query -> execute();
                $reservations = $query -> fetch()['reservations'];
            ?>
            <h2>Réservations</h2>
            <h3><?= $reservations ?> réservations effectuées</h3>
            <div class="btn-list">
                <a class="btn" href="reservations">Voir les réservations</a>
                <a class="btn" href="reservations/create.php">Ajouter une réservation</a>
            </div>
        </div>

        <div class="card">
            <?php
                $query = $bd -> prepare('SELECT COUNT(*) AS testimonials FROM testimonials');
                $query -> execute();
                $testimonials = $query -> fetch()['testimonials'];
            ?>
            <h2>Avis</h2>
            <h3><?= $testimonials ?> avis donnés aux utilisateurs</h3>
            <div class="btn-list">
                <a class="btn" href="testimonials">Voir les avis</a>
                <a class="btn" href="testimonials/create.php">Ajouter un avis</a>
            </div>
        </div>

        <div class="card">
            <?php
                $query = $bd -> prepare('SELECT COUNT(*) AS parkings FROM parkings');
                $query -> execute();
                $parkings = $query -> fetch()['parkings'];
            ?>
            <h2>Parkings</h2>
            <h3><?= $parkings ?> parkings enregistrés</h3>
            <div class="btn-list">
                <a class="btn" href="parkings">Voir les parkings</a>
                <a class="btn" href="parkings/create.php">Ajouter un parking</a>
            </div>
        </div>
    </div>
    </section>
</main>