<?= isset($_SESSION['crudLog']) ? '<p>' . $_SESSION['crudLog'] . '</p>' : '' ?>

<form action="./create.php" method="post">
    <div>
        <label for="parking_name">Nom du parking</label>
        <!-- <select name="parking_name" id="parking_name">
            <option value="p1">Parking IUT 1</option>
            <option value="p2">Parking IUT 2</option>
            <option value="other">Autre</option>
        </select> -->
        <input type="text" name="parking_name" id="parking_name" placeholder="Nom du parking a ajouter">
    </div>
    <div>
        <label for="area_name">Nom de la zone</label>
        <input type="text" name="area_name" id="area_name" placeholder="Nom de la zone">
    </div>

    <button class="btn green" type="submit">Valider l'ajout</button>
</form>