<p>Bonjour,</p>
<h1><?= $_SESSION['firstname'] ?> !</h1>
<img src="assets/images/avatars/<?= $_SESSION['picture'] ?>" alt="Profile picture" style="display: block;">

<h2>Mes informations personnelles</h2>

<form action="" method="post">
    <div>
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" value="<?= $_SESSION['firstname'] ?>">
    </div>
    <div>
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="<?= $_SESSION['name'] ?>">
    </div>
    <div>
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" value="<?= $_SESSION['email'] ?>">
    </div>
    <div>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" placeholder="Nouveau mot de passe...">
        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirmer le mot de passe actuel">
    </div>

    <h2>Mon véhicule</h2>

    <?php
        $db = dbConnect();
        $query = $db -> prepare('SELECT * FROM vehicles WHERE user_id = ' . $_SESSION['user_id']);
        $query -> execute();

        if($query -> rowCount() > 0) {
            $vehicles = $query -> fetchAll();
            foreach($vehicles as $vehicle) {
                $brand = $vehicle['brand'];
                $model = $vehicle['model'];
                $color = $vehicle['color'];
                $sits = $vehicle['places'];
            }
        }

        dbDisconnect($db);
    ?>

    <div>
        <input type="text" id="brand" name="brand" <?= isset($brand) ? 'value="'.$brand.'"' : 'placeholder="Marque"' ?>>
    </div>
    <div>
        <input type="text" id="model" name="model" <?= isset($model) ? 'value="'.$model.'"' : 'placeholder="Modèle"' ?>>
    </div>
    <div>
        <input type="text" id="color" name="color" <?= isset($color) ? 'value="'.$color.'"' : 'placeholder="Couleur"' ?>>
    </div>
    <div>
        <input type="number" name="sits" id="sits" <?= isset($sits) ? 'value="'.$sits.'"' : 'placeholder="Nombre de places"' ?>>
    </div>

    <button class="btn green" type="submit">Mettre à jour</button>
</form>

<a href="deconnexion.php" class="btn">Déconnexion</a>

<button id="deleteAcc">Supprimer mon compte</button>

<form id="deleteAcc_form" action="desinscription.php" method="post">
    <label for="password">Confirmez votre mot de passe</label>
    <input type="password" name="delete_password" id="delete_password" placeholder="Mot de passe">

    <button class="btn green" type="submit">Supprimer définitivement mon compte</button>
</form>

<script src="assets/js/profile.js"></script>