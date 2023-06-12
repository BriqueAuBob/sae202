<?= isset($_SESSION['crudLog']) ? '<p>' . $_SESSION['crudLog'] . '</p>' : '' ?>

<form action="./create.php" method="post" enctype="multipart/form-data">
    <div>
        <label for="brand">Marque</label>
        <input type="text" name="brand" id="brand" placeholder="marque">
    </div>
    <div>
        <label for="model">Modèle</label>
        <input type="text" name="model" id="model" placeholder="modèle">
    </div>
    <div>
        <label for="seats">Places</label>
        <input type="number" name="seats" id="seats" min="1" max="99" placeholder="nombre de places">
    </div>
    <div>
        <label for="color">Couleur</label>
        <input type="text" name="color" id="color" placeholder="couleur">
    </div>
    <div>
        <label for="picture">Photo du véhicule</label>
        <input type="file" name="picture" id="picture">
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
                    echo '<option value="' . $user['id'] . '">' . $user['first_name'] . ' ' . $user['last_name'] . '</option>';
                }
            ?>
        </select>
    </div>

    <button class="btn green" type="submit">Valider l'ajout</button>
</form>

<?php 
    unset($_SESSION['crudLog']);
    dbDisconnect($bd);
?>