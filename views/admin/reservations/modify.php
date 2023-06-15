<?php
$bd = dbConnect();
$user_id = $_GET['user_id'];
$trip_id = $_GET['trip_id'];

$query = $bd->prepare('SELECT * FROM users WHERE id = :id');
$query->execute([
        'id' => $user_id
    ]);
$users = $query->fetch();

$query = $bd->prepare('SELECT * FROM trips');
$query->execute();
$trips = $query->fetchAll();
?>

<section class="container">
    <h1 class="center">Modification de la réservation</h1>
<form method="post" enctype="multipart/form-data">
    <section class="form container">
        <input type="hidden" name="user_id" value="<?= $user_id ?>">
        <input type="hidden" name="old_trip_id" value="<?= $trip_id ?>">
        <div>
            <p>Utilisateur : <?= $users['first_name'] . " " . $users['last_name'] ?></p>
        </div>
        <div>
            <select name="trip_id" id="trip_id">
                <?php foreach($trips as $trip): ?>
                    <?php if($trip['id'] == $trip_id) : ?>
                        <option value="<?= $trip['id'] ?>" selected><?= $trip['departure_address'] . ", " . $trip['departure_city'] . ' -> ' . $trip['destination_address'] . ", " . $trip['destination_city'] ?></option>
                    <?php else : ?>
                        <option value="<?= $trip['id'] ?>"><?= $trip['departure_address'] . ", " . $trip['departure_city'] . ' -> ' . $trip['destination_address'] . ", " . $trip['destination_city'] ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>

        <button class="btn green" type="submit">Valider la modification</button>
    </section>
</form>
</section>

<?php
    unset($_SESSION['crudLog']);
    dbDisconnect($bd);
?>