<?= isset($_SESSION['crudLog']) ? '<p>' . $_SESSION['crudLog'] . '</p>' : '' ?>

<form action="./create.php" method="post" enctype="multipart/form-data">
<div>
        <label for="last_name">Nom</label>
        <input type="text" name="last_name" id="last_name" placeholder="nom">
    </div>
    <div>
        <label for="first_name">Prénom</label>
        <input type="text" name="first_name" id="first_name" placeholder="prénom">
    </div>
    <div>
        <label for="picture">Photo de profil</label>
        <input type="file" name="picture" id="picture">
    </div>
    <div>
        <label for="email">Adresse mail</label>
        <input type="email" name="email" id="email" placeholder="email">
    </div>
    <div>
        <label for="password">Mot de passe (hashage automatique)</label>
        <input type="text" name="password" id="password" placeholder="mot de passe">
    </div>
    <div>
        <label for="status">Status</label>
        <select name="status">
            <option value="0">Aucun</option>
            <option value="1">Covoitureur</option>
            <option value="2">Passager</option>
        </select>
    </div>

    <button class="btn green" type="submit">Valider l'ajout</button>
</form>

<?php
    unset($_SESSION['crudLog']);
?>