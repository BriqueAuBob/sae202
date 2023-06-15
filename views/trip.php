<?php
$db = dbConnect();
$id = $_GET['id'];
$query = $db->prepare('SELECT *, trips.id as trip_id FROM trips 
INNER JOIN users ON trips.user_id = users.id 
INNER JOIN vehicles ON vehicles.user_id = users.id
WHERE trips.id = ?');
$query->execute([
    $id
]);
$trip = $query->fetch();
if (!$trip) {
    header('Location: /404.php');
    exit;
}
?>
<header class="small">
    <h1>Trajet de
        <?= $trip['first_name'] . ' ' . $trip['last_name'] ?>
    </h1>
    <h2>
        <?= $trip['departure_city'] ?>,
        <?= $trip['departure_address'] ?> >
        <?= $trip['destination_city'] ?>,
        <?= $trip['destination_address'] ?>
    </h2>
</header>
<section class="container grid cols-3 align-top">
    <div class="col-2">
        <div class="card big">
            <div class="card-header">
                <h3>Informations</h3>
            </div>
            <div class="card-body">
                <ul>
                    <li><strong>Départ:</strong>
                        <?= $trip['departure_city'] ?>,
                        <?= $trip['departure_address'] ?>
                    </li>
                    <li><strong>Destination:</strong>
                        <?= $trip['destination_city'] ?>,
                        <?= $trip['destination_address'] ?>
                    </li>
                    <li><strong>Date et heure:</strong>
                        <?= $trip['departure_at'] ?>
                    </li>
                    <li><strong>Nombre de places:</strong>
                        <?= $trip['seats'] ?>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card big mt-sm">
            <div class="card-header">
                <h3>Avis</h3>
            </div>
            <div class="card-body">
                <div>
                    <li>
                        <img class="avatar" src="/assets/images/avatars/<?= $trip['picture'] ?>"/> Melvil Pasdeloup <img class="icons" src="/assets/images/icons/star.svg" />
                    </li>
                    <li><strong>Avis : </strong>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fugiat magnam temporibus,
                            necessitatibus neque ullam itaque animi dolores vitae modi corrupti dignissimos est
                            reiciendis?
                            Odio, quibusdam expedita ratione fugit exercitationem facilis.</p>
                    </li>
                </div>
            </div>
        </div>
    </div>

    <aside class="card big">
        <h3>Conducteur</h3>
        <div class="flex">
            <img class="avatar" src="/assets/images/avatars/<?= $trip['picture'] ?>"
                alt="Photo de profil de <?= $trip['first_name'] . ' ' . $trip['last_name'] ?>">
            <span>
                <?= $trip['first_name'] . ' ' . $trip['last_name'] ?>
            </span>
        </div>
        <h3 class="mt-sm">Véhicule</h3>
        <img src="/assets/images/vehicles/<?= $trip['image'] ?>" alt="<?= $trip['brand'] . ' ' . $trip['model'] ?>">
        <span>
            <?= $trip['brand'] . ' ' . $trip['model'] . ' - ' . $trip['color'] ?>
        </span>
        <a href="/reservation.php?trip_id=<?= $trip['trip_id'] ?>" class="btn green full mt-md">Réserver le trajet</a>
    </aside>
</section>