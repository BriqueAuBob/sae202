<?php
$bd = dbConnect();

$query = $bd->prepare('SELECT * FROM parkings ORDER BY name ASC');
$query->execute();
$parkings = $query->fetchAll();
?>

<h1>Gestion des parkings</h1>
<?= isset($_SESSION['crudLog']) ? '<p>' . $_SESSION['crudLog'] . '</p>' : '' ?>

<a href="create.php" class="btn green">Ajouter un parking</a>

<table border style="margin-top: 24px;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Zone</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($parkings as $parking) : ?>
            <tr>
                <td><?= $parking['id'] ?></td>
                <td><?= $parking['name'] ?></td>
                <td><?= $parking['area'] ?></td>
                <th><a href="modifications.php?id=<?= $parking['id'] ?>">Modifier</a></th>
                <th><a href="delete.php?id=<?= $parking['id'] ?>">Supprimer</a></th>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
$_SESSION['crudLog'] = '';
?>