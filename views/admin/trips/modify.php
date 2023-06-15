<section class="container">
<?= isset($_SESSION['crudLog']) ? '<p>' . $_SESSION['crudLog'] . '</p>' : '' ?>

<?php
    $bd = dbConnect();

    $id = $_GET['id'];

    $query = $bd->prepare('SELECT * FROM trips WHERE id = :id');
    $query->execute(['id' => $id]);
    $trip = $query->fetch();
?>

<h1 class="center">Modification du trajet</h1>

<form action="./modifications.php" method="post">
    <section class="form container">
    <input type="hidden" name="id" value="<?= $trip['id'] ?>">
    <div class="form-group">
        <div>
            <label for="dep_city">Ville de départ*</label>
            <input type="text" name="dep_city" id="dep_city" placeholder="Ville de départ" value="<?= $trip['departure_city'] ?>">
        </div>
        <div>
            <label for="dep_address">Adresse de départ</label>
            <input type="text" name="dep_address" id="dep_address" placeholder="Adresse de départ" value="<?= $trip['departure_address'] ?>">
        </div>
    </div>
    <div>
        <label for="dep_at">Départ le*</label>
        <input type="datetime-local" name="dep_at" id="dep_at" value="<?= $trip['departure_at'] ?>">
    </div>
    <div class="form-group">
        <div>
            <label for="des_city">Ville d'arrivée*</label>
            <input type="text" name="des_city" id="des_city" placeholder="Ville d'arrivée" value="<?= $trip['destination_city'] ?>">
        </div>
        <div>
        <label for="des_address">Adresse d'arrivée</label>
            <input type="text" name="des_address" id="des_address" placeholder="Adresse d'arrivée" value="<?= $trip['destination_address'] ?>">
        </div>
    </div>
    <div>
        <label for="seats">Places*</label>
        <input type="number" name="seats" id="seats" min="1" max="99" placeholder="Places" value="<?= $trip['seats'] ?>">
    </div>
    <div>
        <label for="driver">Conducteur*</label>
        <select name="driver" id="driver">
            <?php
                $bd = dbConnect();

                $query = $bd->query('SELECT * FROM users');
                $drivers = $query->fetchAll();
            ?>
            <?php foreach ($drivers as $driver): ?>
                <?php if ($driver['id'] == $trip['user_id']) : ?>
                    <option value="<?= $driver['id'] ?>" selected><?= $driver['first_name'] . ' ' . $driver['last_name'] ?></option>
                <?php else : ?>
                    <option value="<?= $driver['id'] ?>"><?= $driver['first_name'] . ' ' . $driver['last_name'] ?></option>
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