<?php
    $bd = dbConnect();
    $id = $_GET['id'];

    $query = $bd -> prepare('SELECT * FROM users WHERE id = :id');
    $query -> execute(array(
        'id' => $id
    ));
    $user = $query -> fetch();
?>

<form action="../users_update.php" method="post">
    <input type="hidden" name="id" value="<?= $user['id'] ?>">

    <label for="last_name">Nom</label>
    <input type="text" name="last_name" id="last_name" value="<?= $user['last_name'] ?>">

    <label for="first_name">Prénom</label>
    <input type="text" name="first_name" id="first_name" value="<?= $user['first_name'] ?>">
    
    <label for="picture">Photo de profil</label>
    <input type="text" name="picture" id="picture" value="<?= $user['picture'] ?>">

    <label for="email">Adresse mail</label>
    <input type="text" name="email" id="email" value="<?= $user['email'] ?>">

    <label for="password">Mot de passe</label>
    <input type="text" name="password" id="password" value="<?= $user['password'] ?>">

    <label for="status">Status</label>
    <select name="status">
        
    </select>

    <label for="created_at">Date de création</label>
    <input type="text" name="created_at" id="created_at" value="<?= $user['created_at'] ?>">
    
    <button class="btn green" type="submit">Valider la modification</button>
</form>