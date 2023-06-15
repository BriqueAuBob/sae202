<section class="container">
<?= isset($_SESSION['crudLog']) ? '<p>' . $_SESSION['crudLog'] . '</p>' : '' ?>

<h1 class="center">Ajouter un trajet</h1>

<form action="./create.php" method="post">
    <section class="form container">
    <div class="form-group">
        <div>
            <label for="dep_city">Ville de départ*</label>
            <input type="text" name="dep_city" id="dep_city" placeholder="Ville de départ">
        </div>
        <div>
            <label for="dep_address">Adresse de départ</label>
            <input type="text" name="dep_address" id="dep_address" placeholder="Adresse de départ">
        </div>
    </div>
    <div>
        <label for="dep_at">Départ le*</label>
        <input type="datetime-local" name="dep_at" id="dep_at">
    </div>
    <div class="form-group">
        <div>
            <label for="des_city">Ville d'arrivée*</label>
            <input type="text" name="des_city" id="des_city" placeholder="Ville d'arrivée">
        </div>
        <div>
        <label for="des_address">Adresse d'arrivée</label>
            <input type="text" name="des_address" id="des_address" placeholder="Adresse d'arrivée">
        </div>
    </div>
    <div>
        <label for="seats">Places*</label>
        <input type="number" name="seats" id="seats" min="1" max="99" placeholder="Places">
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
                <option value="<?= $driver['id'] ?>"><?= $driver['first_name'] . ' ' . $driver['last_name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <button class="btn green" type="submit">Valider l'ajout</button>
    </section>
</form>
</section>

<?php 
    unset($_SESSION['crudLog']);
    dbDisconnect($bd);
?>