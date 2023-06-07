<?php
    $bd = dbConnect();

    $query = $bd -> prepare('SELECT * FROM users');
    $query -> execute();
    $users = $query -> fetchAll();
?>

<table border>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Photo de profil</th>
            <th>Adresse mail</th>
            <th>Mot de passe</th>
            <th>Status</th>
            <th>Date de création</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['last_name'] ?></td>
                <td><?= $user['first_name'] ?></td>
                <td><?= $user['picture'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['password'] ?></td>
                <td><?= $user['status'] ?></td>
                <td><?= $user['created_at'] ?></td>
                <th><a href="forms/users_update_form.php?id=<?= $user['id'] ?>">Modifier</a></th>
                <th><a href="users_delete.php?id=<?= $user['id'] ?>">Supprimer</a></th>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>