<?php
    $bd = dbConnect();

    $query = $bd->prepare('SELECT * FROM users');
    $query->execute();
    $users = $query->fetchAll();

    $query = $bd->prepare('SELECT * FROM trips');
    $query->execute();
    $trips = $query->fetchAll();
?>

<section class="container">
    <h1 class="center">Ajouter une réservation</h1>

    <?= isset($_SESSION['crudLog']) ? '<p>' . $_SESSION['crudLog'] . '</p>' : '' ?>

    <form action="./create.php" method="post" enctype="multipart/form-data">
        <section class="form container">
            <div class="form-group">
                <select name="user_id" id="user_id">
                    <?php foreach($users as $user): ?>
                        <option value="<?= $user['id'] ?>"><?= $user['first_name'] . ' ' . $user['last_name'] ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="trip_id" id="trip_id">
                    <?php foreach($trips as $trip): ?>
                        <option value="<?= $trip['id'] ?>"><?= $trip['departure_address'] . ", " . $trip['departure_city'] . ' -> ' . $trip['destination_address'] . ", " . $trip['destination_city'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button class="btn green" type="submit">Valider l'ajout</button>
        </section>
    </form>
</section>

<?php
    unset($_SESSION['crudLog']);
?>