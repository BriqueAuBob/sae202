<?php
    $bd = dbConnect();
    $id = $_GET['id'];

    $query = $bd -> prepare('SELECT * FROM users WHERE id = :id');
    $query -> execute(array(
        'id' => $id
    ));
    $user = $query -> fetch();
?>

<form action="../users_update.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $user['id'] ?>">
    <div>
        <label for="last_name">Nom</label>
        <input type="text" name="last_name" id="last_name" value="<?= $user['last_name'] ?>">
    </div>
    <div>
        <label for="first_name">Prénom</label>
        <input type="text" name="first_name" id="first_name" value="<?= $user['first_name'] ?>">
    </div>   
    <div>
        <label for="picture">Photo de profil</label>
        <input type="file" name="picture" id="picture">
        <img src="../../assets/images/avatars/<?= $user['picture'] ?>" alt="Photo de profil utilisateur">
    </div>
    <div>
        <label for="email">Adresse mail</label>
        <input type="text" name="email" id="email" value="<?= $user['email'] ?>">
    </div>
    <div>
        <label for="password">Mot de passe (hashage automatique)</label>
        <input type="text" name="password" id="password" value="<?= $user['password'] ?>">
    </div>
    <div>
        <label for="status">Status</label>
        <select name="status">
            <option value="0" <?php if($user['status'] == '') echo 'selected' ?>>Aucun</option>
            <option value="1" <?php if($user['status'] == 'covoitureur') echo 'selected' ?>>Covoitureur</option>
            <option value="2" <?php if($user['status'] == 'passager') echo 'selected' ?>>Passager</option>
        </select>
    </div>
    <div>
        <label for="created_at">Date de création</label>
        <input type="text" name="created_at" id="created_at" value="<?= $user['created_at'] ?>">
    </div>
    <button class="btn green" type="submit">Valider la modification</button>
</form>