<?php
    $bd = dbConnect();
    $id = $_GET['id'];

    $query = $bd->prepare('SELECT * FROM vehicles WHERE id = :id');
    $query->execute(array(
        'id' => $id
    ));
    $vehicle = $query->fetch();
?>

<?= isset($_SESSION['crudLog']) ? '<p>' . $_SESSION['crudLog'] . '</p>' : '' ?>

<form action="./modifications.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $vehicle['id'] ?>">
    <div>
        <label for="brand">Marque</label>
        <input type="text" name="brand" id="brand" placeholder="marque" value="<?= $vehicle['brand'] ?>">
    </div>
    <div>
        <label for="model">Modèle</label>
        <input type="text" name="model" id="model" placeholder="modèle" value="<?= $vehicle['model'] ?>">
    </div>
    <div>
        <label for="seats">Places</label>
        <input type="number" name="seats" id="seats" min="1" max="99" placeholder="nombre de places" value="<?= $vehicle['places'] ?>">
    </div>
    <div>
        <label for="color">Couleur</label>
        <input type="text" name="color" id="color" placeholder="couleur" value="<?= $vehicle['color'] ?>">
    </div>
    <div>
        <label for="picture">Photo du véhicule</label>
        <input type="file" name="picture" id="picture">
        <img src="../../assets/images/vehicles/<?= $vehicle['image'] ?>" alt="Photo du véhicule">
    </div>
    <div>
        <label for="status">Utilisateur associé</label>
        <select name="user">
            <?php
                $bd = dbConnect();

                $query = $bd -> prepare('SELECT * FROM users');
                $query -> execute();
                $users = $query -> fetchAll();

                foreach ($users as $user) {
                    if($user['id'] == $vehicle['user_id']) {
                        echo '<option value="' . $user['id'] . '" selected>' . $user['last_name'] . ' ' . $user['first_name'] . '</option>';
                    } else {
                        echo '<option value="' . $user['id'] . '">' . $user['last_name'] . ' ' . $user['first_name'] . '</option>';
                    }
                }
            ?>
        </select>
    </div>

    <button class="btn green" type="submit">Valider la modification</button>
</form>

<?php
    unset($_SESSION['crudLog']);
    dbDisconnect($bd);
?>