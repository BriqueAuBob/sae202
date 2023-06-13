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
<section>
    <div class="container">
        <div class="grid cols-3 mt-md">
            <?php
            include('./components/card_trip.php');
            for ($i = 0; $i < 24; $i++) {
                cardTrip();
            }
            ?>
        </div>
    </div>
</section>



<!-- <?= isset($_SESSION['user']['id']) ? '<button id="trip_reveal" class="btn green">Nouveau trajet</button>' : '' ?>

<form id="trip_form" action="trips_create.php" method="post">
    <p>PROTOTYPE</p>
    <p>Définir le point de rendez-vous</p>
    <div>
        <label for="departure_city">Ville de départ</label>
        <input type="text" id="departure_city" name="departure_city" placeholder="Ville de départ">
    </div>
    <div>
        <select name="departure_options" id="departure_options">
        <option value="other">Hors parkings de l'IUT</option>
            <option value="p1">Parking IUT 1</option>
            <option value="p2">Parking IUT 2</option>
        </select>
        <svg id="p1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width=200px height=auto x="0px" y="0px" viewBox="0 0 613 1054.67" style="enable-background:new 0 0 613 1054.67;" xml:space="preserve">
            <style type="text/css">
                .st0{fill:#E6E6E6;stroke:#E52421;stroke-miterlimit:10;}
            </style>
            <g>
                    <rect id="p1z1" x="-57.52" y="216.71" transform="matrix(0.8108 0.5853 -0.5853 0.8108 191.9382 -136.7077)" class="st0" width="729.95" height="23.74"/>
                    <rect id="p1z2" x="462.3" y="589.4" transform="matrix(-8.426597e-07 -1 1 -8.426597e-07 -33.0282 1169.5138)" class="st0" width="211.88" height="23.74"/>
                    <rect id="p1z3" x="429.16" y="660.1" transform="matrix(-1.092025e-06 -1 1 -1.092025e-06 -161.0593 1182.8784)" class="st0" width="163.49" height="23.74"/>
                    <rect id="p1z4" x="253.82" y="858.8" transform="matrix(-0.7539 0.657 -0.657 -0.7539 1249.8707 1273.1616)" class="st0" width="265.34" height="23.74"/>
                    <rect id="p1z5" x="220.87" y="895.35" transform="matrix(-0.7539 0.657 -0.657 -0.7539 1348.469 1309.3286)" class="st0" width="416.29" height="23.74"/>
            </g>
        </svg>
        <svg id="p2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width=200px height=auto x="0px" y="0px" viewBox="0 0 613 1054.67" style="enable-background:new 0 0 613 1054.67;" xml:space="preserve">
            <style type="text/css">
                .st1{fill:#AAA;stroke:#E52421;stroke-miterlimit:10;}
            </style>
            <g>
                    <rect id="p2z1" x="-57.52" y="216.71" transform="matrix(0.8108 0.5853 -0.5853 0.8108 191.9382 -136.7077)" class="st1" width="729.95" height="23.74"/>
                    <rect id="p2z2" x="462.3" y="589.4" transform="matrix(-8.426597e-07 -1 1 -8.426597e-07 -33.0282 1169.5138)" class="st1" width="211.88" height="23.74"/>
                    <rect id="p2z3" x="429.16" y="660.1" transform="matrix(-1.092025e-06 -1 1 -1.092025e-06 -161.0593 1182.8784)" class="st1" width="163.49" height="23.74"/>
                    <rect id="p2z4" x="253.82" y="858.8" transform="matrix(-0.7539 0.657 -0.657 -0.7539 1249.8707 1273.1616)" class="st1" width="265.34" height="23.74"/>
                    <rect id="p2z5" x="220.87" y="895.35" transform="matrix(-0.7539 0.657 -0.657 -0.7539 1348.469 1309.3286)" class="st1" width="416.29" height="23.74"/>
            </g>
        </svg>
        <label for="departure_address">Adresse de départ</label>
        <input type="text" id="departure_address" name="departure_address" placeholder="Adresse de départ">
    </div>
    <div>
        <input type="datetime-local" id="departure_date" name="departure_date">
    </div>
    <p>Définir le point d'arrivée</p>
    <div>
        <label for="destination_city">Ville de destination</label>
        <input type="text" id="destination_city" name="destination_city" placeholder="Ville d'arrivée">
    </div>
    <div>
        <label for="destination_address">Adresse de destination</label>
        <input type="text" id="destination_address" name="destination_address" placeholder="Adresse de destination">
    </div>

    <button type="submit" class="btn green">Valider le trajet</button>
</form>

<script src="assets/js/trip_parking.js"></script> -->