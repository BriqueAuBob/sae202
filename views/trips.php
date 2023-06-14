<header class="small">
    <div class="container">
        <h1>Prenez un billet pour vos trajets</h1>
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
<section>
    <div class="container">
        <div class="grid cols-3 mt-md">
            <?php
                $db=dbConnect();
                $query = $db->query('SELECT trips.id AS trip_id, vehicles.id AS vehicle_id, trips.*, trips.destination_city as `to`, trips.seats as `seats`, trips.departure_at as `date`, trips.departure_city as `from`, CONCAT("/vehicles/", vehicles.image) as `image`, users.* FROM trips INNER JOIN users ON trips.user_id = users.id INNER JOIN vehicles ON trips.vehicle_id = vehicles.id ORDER BY trips.created_at DESC');
                $trips = $query->fetchAll();
            
                include('./components/card_trip.php');
                foreach ($trips as $trip){
                    if (strtotime($trip['date']) > strtotime(date('Y-m-d H:i:s'))) {
                        cardTrip($trip, dark: true, url: '/trajet.php?id=' . $trip['id']);
                    }
                }
        </div>
    </div>
</section>