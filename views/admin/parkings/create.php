<?= isset($_SESSION['crudLog']) ? '<p>' . $_SESSION['crudLog'] . '</p>' : '' ?>

<form action="./create.php" method="post" enctype="multipart/form-data">
    <div>
        <label for="parking_name">Nom du parking</label>
        <input type="text" name="parking_name" id="parking_name" placeholder="Nom">
    </div>
    <div>
        <label for="adress">Adresse du parking</label>
        <input type="text" name="adress" id="adress" placeholder="Adresse">
    </div>
    <div>
        <label for="location">Lien MAPS de l'emplacement</label>
        <input type="text" name="location" id="location" placeholder="Emplacement MAPS">
    </div>
    <div>
        <label for="spaces">Nombre de places disponibles</label>
        <input type="number" name="spaces" id="spaces" min="0" max="999" placeholder="Nombre de places">
    </div>
    <div>
        <label for="picture">Photo du parking</label>
        <input type="file" name="picture" id="picture">
    </div>

    <button class="btn green" type="submit">Valider l'ajout</button>
</form>