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
        <p>Notre site VrooMMI est un site de covoiturage qui repose sur l'entraide entre étudiants, car nous ne disposons pas de système de paiement. Les trajets proposés visent principalement à se rendre à l'IUT, avec des points de départ et d'arrivée situés sur les parkings n°1 et n°2, ainsi que les places se trouvant devant l'IUT. Notre site incarne des valeurs écologiques grâce à son offre de covoiturage, mais aussi grâce à sa conception qui s'inscrit dans une approche éco-conceptive.</p>
    </div>
    <img class="full" src="./assets/images/car.svg" alt="car">
</section>
<section class="green">
    <div class="container">
        <h1>Nos fonctionnalités principales</h1>
        <p>Vous pourriez vous demander ce qui nous distingue des autres sites de covoiturage. Voyez quelques fonctionnalités</p>
        <div class="grid cols-3 mt-md">
            <div class="card big">
                <div class="title">
                    <img src="./assets/images/icons/load_icon.svg" alt="load">
                    <h2>Réservation de trajets</h2>
                </div>
                <p>Il est possible de réserver son trajet pour se déplacer où vous le voulez et en toute simplicité.</p>
            </div>
            <div class="card big">
                <div class="title">
                    <img src="./assets/images/icons/load_icon.svg" alt="load">
                    <h2>Sélection de l'emplacement</h2>
                </div>
                <p>Vous pouvez indiquer l'emplacement de votre place pour faciliter le lieu de rendez-vous.</p>
            </div>
            <div class="card big">
                <div class="title">
                    <img src="./assets/images/icons/load_icon.svg" alt="load">
                    <h2>Une organisation parfaite</h2>
                </div>
                <p>Avec notre système de messagerie instantanée vous pouvez discuter avec le covoitureur pour tout planifier avant de partir.</p>
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
        <p>Voici comment fonctionne notre système pour la réservation de trajet.</p>
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
                    cardTrip();
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
            <h2>Pourquoi utiliser le site?</h2>
            <p>VrooMMI est avant tout un site qui se base sur l’entraide entre étudiant car celui-ci ne possède pas de système de paiement et notre site est inscrit dans une démarche éco-conceptive. En plus on est meilleur que les autres et ca c’est un bon point.</p>
        </div>
        <div class="card big">
            <h2>Comment suis-je débité ?</h2>
            <p>Personne n’est débité puisque notre site ne possède pas de système de paiement. Tout est basé sur le volontariat du conducteur mais tu peux offrir quelque chose en échange pour que cela soit gagnant pour les deux.</p>
        </div>
        <div class="card big">
            <h2>Peut-on prendre plusieurs passagers ?</h2>
            <p>Bien sûr il est possible de prendre plusieurs passagers et c’est même le but du covoiturage. Lorsque tu t’inscris sur VrooMMI tu indiques si tu as une voiture et combien de places elle possède comme ça les personnes voulant faire le même trajet que toi savent combien de places tu as.</p>
        </div>
        <div class="card big">
            <h2>Peut-on annuler un trajet ?</h2>
            <p>Oui vous êtes dans la capacité d’annuler un trajet, que ce soit pour des raisons personnelles ou non. Ensuite le site s’occupe de prévenir les personnes qui avait déjà prévu de partager le trajet avec vous.</p>
        </div>
    </div>
</section>