<?php
    $bd = dbConnect();
    $id = $_GET['id'];

    $query = $bd->prepare('SELECT * FROM users WHERE id = :id');
    $query->execute(array(
        'id' => $id
    ));
    $user = $query->fetch();
?>

<form action="./modifications.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $user['id'] ?>">
    <div>
        <label for="last_name">Nom</label>
        <input type="text" name="last_name" id="last_name" placeholder="nom de famille" value="<?= $user['last_name'] ?>">
    </div>
    <div>
        <label for="first_name">Prénom</label>
        <input type="text" name="first_name" id="first_name" placeholder="prénom" value="<?= $user['first_name'] ?>">
    </div>
    <div>
        <label for="picture">Photo de profil</label>
        <input type="file" name="picture" id="picture">
        <img src="../../assets/images/avatars/<?= $user['picture'] ?>" alt="Photo de profil utilisateur">
    </div>
    <div>
        <label for="email">Adresse mail</label>
        <input type="email" name="email" id="email" placeholder="adresse mail" value="<?= $user['email'] ?>">
    </div>
    <div>
        <label for="password">Mot de passe (hashage automatique)</label>
        <input type="text" name="password" id="password" placeholder="mot de passe" value="<?= $user['password'] ?>">
    </div>
    <div>
        <label for="status">Status</label>
        <select name="status">
            <option value="0" <?= $user['status'] == '' ? 'selected' : '' ?>>Aucun</option>
            <option value="1" <?= $user['status'] == 'covoitureur' ? 'selected' : '' ?>>Covoitureur</option>
            <option value="2" <?= $user['status'] == 'passager' ? 'selected' : '' ?>>Passager</option>
        </select>
    </div>
    <div>
        <label for="created_at">Date de création</label>
        <input type="text" name="created_at" id="created_at" value="<?= $user['created_at'] ?>">
    </div>
    <button class="btn green" type="submit">Valider la modification</button>
</form>

<?php
    unset($_SESSION['crudLog']);
    dbDisconnect($bd);
?>