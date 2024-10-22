<section class="container">
<?= isset($_SESSION['crudLog']) ? '<p>' . $_SESSION['crudLog'] . '</p>' : '' ?>

<h1 class="center">Ajouter un utilisateur</h1>

<form action="./create.php" method="post" enctype="multipart/form-data">
    <section class="form container">
        <div class="form-group">
            <div>
                <label for="last_name">Nom</label>
                <input type="text" name="last_name" id="last_name" placeholder="nom">
            </div>
            <div>
                <label for="first_name">Prénom</label>
                <input type="text" name="first_name" id="first_name" placeholder="prénom">
            </div>
        </div>
        <div class="form-group">
            <div>
                <label for="email">Adresse mail</label>
                <input type="email" name="email" id="email" placeholder="email">
            </div>
            <div>
                <label for="picture">Photo de profil</label>
                <input type="file" name="picture" id="picture">
            </div>
        </div>
        <div>
            <label for="password">Mot de passe (hashage automatique)</label>
            <input type="password" name="password" id="password" placeholder="mot de passe">
        </div>

        <button class="btn green" type="submit">Valider l'ajout</button>
    </section>
</form>
</section>

<?php
    unset($_SESSION['crudLog']);
?>