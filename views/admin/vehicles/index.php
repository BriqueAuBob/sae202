<?php
    $bd = dbConnect();

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['sort_by'])) {
            switch(isset($_POST['sort_by'])) {
                case 'id_asc':
                    $query = $bd->prepare('SELECT * FROM vehicles ORDER BY id ASC');
                    break;
                case 'id_desc':
                    $query = $bd->prepare('SELECT * FROM vehicles ORDER BY id DESC');
                    break;
                case 'brand_asc':
                    $query = $bd->prepare('SELECT * FROM vehicles ORDER BY brand ASC');
                    break;
                case 'brand_desc':
                    $query = $bd->prepare('SELECT * FROM vehicles ORDER BY brand DESC');
                    break;
                case 'model_asc':
                    $query = $bd->prepare('SELECT * FROM vehicles ORDER BY model ASC');
                    break;
                case 'model_desc':
                    $query = $bd->prepare('SELECT * FROM vehicles ORDER BY model DESC');
                    break;
                case 'seats_asc':
                    $query = $bd->prepare('SELECT * FROM vehicles ORDER BY places ASC');
                    break;
                case 'seats_desc':
                    $query = $bd->prepare('SELECT * FROM vehicles ORDER BY places DESC');
                    break;
                case 'color_asc':
                    $query = $bd->prepare('SELECT * FROM vehicles ORDER BY color ASC');
                    break;
                case 'color_desc':
                    $query = $bd->prepare('SELECT * FROM vehicles ORDER BY color DESC');
                    break;
                case 'owner_asc':
                    $query = $bd->prepare('SELECT * FROM vehicles ORDER BY user_id ASC');
                    break;
                case 'owner_desc':
                    $query = $bd->prepare('SELECT * FROM vehicles ORDER BY user_id DESC');
                    break;
                default:
                    $query = $bd->prepare('SELECT * FROM vehicles');
                    break;
            }
        }
    }

    $query = $bd->prepare('SELECT vehicles.id AS vehicle_id, vehicles.*, users.* FROM vehicles INNER JOIN users ON vehicles.user_id = users.id');
    $query -> execute();
    $vehicles = $query->fetchAll();
?>

<h1>Gestion des véhicules</h1>
<?= isset($_SESSION['crudLog']) ? '<p>' . $_SESSION['crudLog'] . '</p>': '' ?>

<a href="create.php" class="btn green">Ajouter un véhicule</a>

<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
    <label for="sort_by">Trier par :</label>
    <select name="sort_by" id="sort_by">
        <option value="id_asc">Identifiant (croissant)</option>
        <option value="id_desc">Identifiant (décroissant)</option>
        <option value="brand_asc">Marque (croissant)</option>
        <option value="brand_desc">Marque (décroissant)</option>
        <option value="model_asc">Modèle (croissant)</option>
        <option value="model_desc">Modèle (décroissant)</option>
        <option value="seats_asc">Places (croissant)</option>
        <option value="color_desc">Places (décroissant)</option>
        <option value="color_asc">Couleur (croissant)</option>
        <option value="seats_desc">Couleur (décroissant)</option>
        <option value="owner_asc">Identifiant propriétaire(croissant)</option>
        <option value="owner_desc">Identifiant propriétaire(décroissant)</option>
    </select>
    <button type="submit">Trier</button>
</form>

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