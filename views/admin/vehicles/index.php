<?php
    $bd = dbConnect();

    $query = $bd->prepare('SELECT vehicles.id AS vehicle_id, vehicles.*, users.* FROM vehicles INNER JOIN users ON vehicles.user_id = users.id');
    $query -> execute();
    $vehicles = $query->fetchAll();
?>

<h1>Gestion des véhicules</h1>
<?= isset($_SESSION['crudLog']) ? '<p>' . $_SESSION['crudLog'] . '</p>': '' ?>

<a href="create.php" class="btn green">Ajouter un véhicule</a>

<table border>
    <thead>
        <tr>
            <th>ID</th>
            <th>Marque</th>
            <th>Modèle</th>
            <th>Places</th>
            <th>Couleur</th>
            <th>Image</th>
            <th>Propriétaire</th>
            <th>Identifiant propriétaire</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($vehicles as $vehicle): ?>
            <tr>
                <td><?= $vehicle['vehicle_id'] ?></td>
                <td><?= $vehicle['brand'] ?></td>
                <td><?= $vehicle['model'] ?></td>
                <td><?= $vehicle['places'] ?></td>
                <td><?= $vehicle['color'] ?></td>
                <td><?= $vehicle['image'] ?></td>
                <td><?= $vehicle['first_name'] ?> <?= $vehicle['last_name'] ?></td>
                <td><?= $vehicle['user_id'] ?></td>
                <th><a href="./modifications.php?id=<?= $vehicle['vehicle_id'] ?>">Modifier</a></th>
                <th><a href="delete.php?from=<?= basename($_SERVER['PHP_SELF']) ?>&id=<?= $vehicle['vehicle_id'] ?>">Supprimer</a></th>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
    unset($_SESSION['crudLog']);
    dbDisconnect($bd);
?>