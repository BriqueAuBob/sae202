<?php
$bd = dbConnect();
$id = $_GET['id'];

$query = $bd -> prepare('SELECT * FROM parkings WHERE id = :id');
$query -> execute(['id' => $id]);
$parking = $query -> fetch();
?>

<form method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $parking['id'] ?>">
    <div>
        <label for="parking_name">Nom du parking</label>
        <input type="text" name="parking_name" id="parking_name" placeholder="nom" value="<?= $parking['name'] ?>">
    </div>
    <div>
        <label for="address">Adresse</label>
        <input type="text" name="address" id="address" placeholder="adresse" value="<?= $parking['address'] ?>">
    </div>
    <div>
        <label for="location">Lien MAPS de l'emplacement</label>
        <input type="text" name="location" id="location" placeholder="lien maps" value="<?= $parking['location'] ?>">
    </div>
    <div>
        <label for="spaces">Nombre de places disponibles</label>
        <input type="number" name="spaces" id="spaces" min="0" placeholder="nombre de places" value="<?= $parking['spaces'] ?>">
    </div>
    <div>
        <label for="picture">Photo du parking</label>
        <input type="file" name="picture" id="picture">
        <img src="../../assets/images/parkings/<?= $parking['picture'] ?>" alt="Photo du parking">
    </div>
    <button class="btn green" type="submit">Valider la modification</button>
</form>

<?php
    unset($_SESSION['crudLog']);
    dbDisconnect($bd);
?>