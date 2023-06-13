<?php
if (!isAuthenticated()) {
    header('Location: connexion.php');
    die();
}
?>
<form action="./" method="POST" enctype="multipart/form-data">
    <section class="form container">
        <h1 class="center">Informations personnelles</h1>
        <div class="form-group">
            <div>
                <label for="firstname">Prénom*</label>
                <input type="text" name="firstname" id="firstname" value="<?= $_SESSION['user']['firstname'] ?>">
            </div>
            <div>
                <label for="lastname">Nom*</label>
                <input type="text" name="lastname" id="lastname" value="<?= $_SESSION['user']['name'] ?>">
            </div>
        </div>
        <div>
            <label for="email">Email*</label>
            <input type="email" name="email" id="email" value="<?= $_SESSION['user']['email'] ?>">
        </div>
        <div class="form-group">
            <div>
                <label for="password">Nouveau mot de passe</label>
                <input type="password" name="password" id="password" placeholder="Mot de passe">
            </div>
            <div>
                <label for="password_confirm">Confirmez le nouveau mot de passe</label>
                <input type="password" name="password_confirm" id="password_confirm" placeholder="Mot de passe">
            </div>
        </div>
    </section>
    <section class="form container">
        <h1 class="center">Mon véhicule</h1>
        <?php
        $db = dbConnect();
        $query = $db->prepare('SELECT * FROM vehicles WHERE user_id = ' . $_SESSION['user']['id']);
        $query->execute();

        if ($query->rowCount() > 0) {
            $vehicles = $query->fetchAll();
            foreach ($vehicles as $vehicle) {
                $brand = $vehicle['brand'];
                $model = $vehicle['model'];
                $color = $vehicle['color'];
                $seats = $vehicle['places'];
                $car_picture = $vehicle['image'];
            }
        }

        dbDisconnect($db);
        ?>
        <div class="form-group">
            <div>
                <label for="brand">Marque</label>
                <input type="text" id="brand" name="brand" <?= isset($brand) ? 'value="' . $brand . '"' : 'placeholder="Marque"' ?>>
            </div>
            <div>
                <label for="model">Modèle</label>
                <input type="text" name="model" id="model" <?= isset($model) ? 'value="' . $model . '"' : 'placeholder="Modèle"' ?>>
            </div>
        </div>
        <div class="form-group">
            <div>
                <label for="color">Couleur</label>
                <input type="text" name="color" id="color" <?= isset($color) ? 'value="' . $color . '"' : 'placeholder="Couleur"' ?>>
            </div>
            <div>
                <label for="seats">Nombre de places</label>
                <input type="number" name="seats" id="seats" max="4" <?= isset($seats) ? 'value="' . $seats . '"' : 'placeholder="Nombre de places"' ?>>
            </div>
        </div>
        <div class="half center upload_input">
            <img class="full rounded" src="assets/images/vehicles/<?= $car_picture ?>" alt="Car picture">
            <input type="file" name="car_picture" id="car_picture">
            <div class="gradient">
                Changer la photo
            </div>
        </div>
    </section>
    <div class="save_changes_popup container hidden">
        <p class="big">Enregistrer les modifications ?</p>
        <div class="btn-list">
            <a href="./settings.php" class="btn no-margin">Abandonner les modifications</a>
            <button class="btn no-margin green">Enregistrer</button>
        </div>
    </div>
</form>
<section class="container">
    <h1 class="center">Actions</h1>
    <div class="btn-list center mt-md">
        <a href="./deconnexion.php" class="btn gray">Me déconnecter</a>
        <button class="btn red" type="submit" onclick="openModal('modal_delete_account')">Supprimer définitivement mon compte</button>
    </div>
</section>
<div class="modal hidden" id="modal_delete_account">
    <form action="./desinscription.php" method="POST">
        <div class="modal-container">
            <main>
                <h1>Supprimer mon compte</h1>
                <p>Êtes-vous sûr de vouloir supprimer définitivement votre compte ? Vous ne serez plus en mesure de le récupérer après et toutes vos réservations en cours seront annulées.</p>
                <p class="mt-sm"><strong>Entre ton mot de passe pour confirmer la suppression de ton compte.</strong></p>
                <label class="hidden" for="password_confirmation_delete">Mot de passe</label>
                <input data-no-trigger-save class="mt-md" type="password" name="password" id="password_confirmation_delete" placeholder="Mot de passe...">
            </main>
            <footer class="btn-list">
                <button type="button" class="btn no-margin" data-close-modal="modal_delete_account">Annuler</button>
                <a href="./desinscription.php" class="btn no-margin red">Supprimer</a>
            </footer>
        </div>
    </form>
</div>

<?php
unset($_SESSION['error']);
unset($_SESSION['message']);
?>