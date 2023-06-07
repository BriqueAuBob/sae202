<header id="head__home">
    <div class="container">
        <h1>Partagez vos trajets en toute tranquillité</h1>
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
<section class="container grid cols-3">
    <div class="col-2">
        <h1>Que faisons nous?</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam quis volutpat tellus. Etiam ac dignissim mi. Ut a gravida enim. Interdum et malesuada fames ac ante ipsum primis in faucibus. Etiam mollis luctus lacus, et gravida nisl varius pretium. Vivamus varius iaculis ex, ut mollis eros ultrices eget. Pellentesque in lacus tortor. Nulla pellentesque risus lobortis, faucibus mauris at, mattis arcu. Pellentesque molestie erat diam, a tristique eros convallis in. Duis convallis dolor neque, nec laoreet enim convallis vel.</p>
    </div>
    <img src="./assets/images/car.png" alt="car">
</section>
<section class="green">
    <div class="container">
        <h1>Nos fonctionnalités principales</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam quis volutpat tellus. Etiam ac dignissim mi.</p>
        <div class="grid cols-3 mt-md">
            <div class="card big">
                <div class="title">
                    <img src="./assets/images/icons/load_icon.svg" alt="load">
                    <h2>Recherche de trajets</h2>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam quis volutpat tellus. Etiam ac dignissim mi.</p>
            </div>
            <div class="card big">
                <div class="title">
                    <img src="./assets/images/icons/load_icon.svg" alt="load">
                    <h2>Recherche de trajets</h2>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam quis volutpat tellus. Etiam ac dignissim mi.</p>
            </div>
            <div class="card big">
                <div class="title">
                    <img src="./assets/images/icons/load_icon.svg" alt="load">
                    <h2>Recherche de trajets</h2>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam quis volutpat tellus. Etiam ac dignissim mi.</p>
            </div>
        </div>
    </div>
</section>
<section class="container">
    <h1 class="center">Quelques statistiques</h1>
    <div class="grid cols-4 mt-md">
        <div class="stat">
            <p>Utilisateurs</p>
            <div>105</div>
        </div>
        <div class="stat">
            <p>Trajets effectués</p>
            <div>123</div>
        </div>
        <div class="stat">
            <p>CO2 évité</p>
            <div>2 tonnes</div>
        </div>
        <div class="stat">
            <p>Distance parcourue</p>
            <div>1000km</div>
        </div>
    </div>
</section>
<section class="black">
    <div class="container">
        <h1>Démonstration</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam quis volutpat tellus. Etiam ac dignissim mi.</p>
        <div class="grid cols-3 mt-md">
            <ol class="buttons">
                <li><button class="btn big active">Trouver un trajet</button></li>
                <li><button class="btn big">Réservation du trajet</button></li>
                <li><button class="btn big">Récompenser le chauffeur</button></li>
            </ol>
            <div class="col-2 grid cols-2 small-gap">
                <?php
                include('./components/card_trip.php');
                for ($i = 0; $i < 4; $i++) {
                    cardTrip($i);
                }
                ?>
            </div>
        </div>
    </div>
</section>
<section class="container">
    <h1 class="center">Questions fréquemment posées</h1>
    <div class="grid cols-2 mt-md small-gap">
        <div class="card big">
            <h2>Comment s'inscrire?</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam quis volutpat tellus. Etiam ac dignissim mi.</p>
        </div>
        <div class="card big">
            <h2>Comment s'inscrire?</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam quis volutpat tellus. Etiam ac dignissim mi.</p>
        </div>
        <div class="card big">
            <h2>Comment s'inscrire?</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam quis volutpat tellus. Etiam ac dignissim mi.</p>
        </div>
        <div class="card big">
            <h2>Comment s'inscrire?</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam quis volutpat tellus. Etiam ac dignissim mi.</p>
        </div>
    </div>
</section>