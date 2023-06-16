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
            <h3>Informations</h3>
            <ul class="no-style">
                <li><strong>Départ:</strong>
                    <?= htmlspecialchars($trip['departure_city']) ?>,
                    <?= htmlspecialchars($trip['departure_address']) ?>
                </li>
                <li><strong>Destination:</strong>
                    <?= htmlspecialchars($trip['destination_city']) ?>,
                    <?= htmlspecialchars($trip['destination_address']) ?>
                </li>
                <li><strong>Date et heure:</strong>
                    <?= htmlspecialchars($trip['departure_at']) ?>
                </li>
                <li><strong>Nombre de places:</strong>
                    <?= htmlspecialchars($trip['seats']) ?>
                </li>
            </ul>
        </div>
        <div class="mt-md">
            <h3>Avis de ce conducteur</h3>
            <?php
            $testimonials = $db->prepare('SELECT *, testimonials.id as testimonial_id FROM testimonials
            INNER JOIN users ON testimonials.author_id = users.id
            WHERE user_id = ?');
            $testimonials->execute([
                $trip['user_id']
            ]);
            $testimonials = $testimonials->fetchAll();
            if (count($testimonials) == 0) {
                echo '<p>Ce conducteur n\'a pas encore reçu d\'avis.</p>';
            } else {
                foreach ($testimonials as $testimonial) {
            ?>
                    <div class="card big mt-sm">
                        <div class="flex space-between">
                            <div class="flex bold">
                                <img class="avatar" src="/assets/images/avatars/<?= $testimonial['picture'] ?>" />
                                <?= htmlspecialchars($testimonial['first_name']) . ' ' . htmlspecialchars($testimonial['last_name']) ?>
                            </div>
                            <div>
                                <?= str_repeat('<img class="icons" src="/assets/images/icons/star_fill.svg" />', $testimonial['stars']) ?>
                                <?= str_repeat('<img class="icons" src="/assets/images/icons/star.svg" />', 5 - $testimonial['stars']) ?>
                            </div>
                        </div>
                        <p>
                            <?= htmlspecialchars($testimonial['content']) ?>
                        </p>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>

    <aside class="card big">
        <h3>Conducteur</h3>
        <div class="flex">
            <img class="avatar" src="/assets/images/avatars/<?= $trip['picture'] ?>" alt="Photo de profil de <?= $trip['first_name'] . ' ' . $trip['last_name'] ?>">
            <span>
                <?= htmlspecialchars($trip['first_name']) . ' ' . htmlspecialchars($trip['last_name']) ?>
            </span>
        </div>
        <h3 class="mt-sm">Véhicule</h3>
        <img src="/assets/images/vehicles/<?= $trip['image'] ?>" alt="<?= htmlspecialchars($trip['brand']) . ' ' . htmlspecialchars($trip['model']) ?>">
        <span>
            <?= htmlspecialchars($trip['brand']) . ' ' . htmlspecialchars($trip['model']) . ' - ' . htmlspecialchars($trip['color']) ?>
        </span>
        <a href="/reservation.php?trip_id=<?= $trip['trip_id'] ?>" class="btn green full mt-md">Réserver le trajet</a>
    </aside>
</section>