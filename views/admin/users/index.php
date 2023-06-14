<?php
    $bd = dbConnect();

    $query = $bd->prepare('SELECT * FROM users');
    $query->execute();
    $users = $query->fetchAll();
?>

<h1>Gestion des utilisateurs</h1>
<?= isset($_SESSION['crudLog']) ? '<p>' . $_SESSION['crudLog'] . '</p>' : '' ?>

<a href="create.php" class="btn green">Ajouter un utilisateur</a>

<table border>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Photo de profil</th>
            <th>Adresse mail</th>
            <th>Status</th>
            <th>Date de création</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['last_name'] ?></td>
                <td><?= $user['first_name'] ?></td>
                <td><?= $user['picture'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['status'] ?></td>
                <td><?= $user['created_at'] ?></td>
                <th><a href="modifications.php?id=<?= $user['id'] ?>">Modifier</a></th>
                <th><a href="delete.php?from=<?= basename($_SERVER['PHP_SELF']) ?>&id=<?= $user['id'] ?>">Supprimer</a></th>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
$_SESSION['crudLog'] = '';
dbDisconnect($bd);
?>