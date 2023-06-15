<?php
    $bd = dbConnect();

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['sort_by'])) {
            switch(isset($_POST['sort_by'])) {
                case 'id_asc':
                    $query = $bd->prepare('SELECT trips.id AS tid, trips.user_id AS user, trips.created_at AS created, trips.*, users.* FROM trips INNER JOIN users ON trips.user_id = users.id ORDER BY trips.id ASC');
                    break;
                case 'id_desc':
                    $query = $bd->prepare('SELECT trips.id AS tid, trips.user_id AS user, trips.created_at AS created, trips.*, users.* FROM trips INNER JOIN users ON trips.user_id = users.id ORDER BY trips.id DESC');
                    break;
                case 'dep_city_asc':
                    $query = $bd->prepare('SELECT trips.id AS tid, trips.user_id AS user, trips.created_at AS created, trips.*, users.* FROM trips INNER JOIN users ON trips.user_id = users.id ORDER BY departure_city ASC');
                    break;
                case 'dep_city_desc':
                    $query = $bd->prepare('SELECT trips.id AS tid, trips.user_id AS user, trips.created_at AS created, trips.*, users.* FROM trips INNER JOIN users ON trips.user_id = users.id ORDER BY departure_city DESC');
                    break;
                case 'dest_city_asc':
                    $query = $bd->prepare('SELECT trips.id AS tid, trips.user_id AS user, trips.created_at AS created, trips.*, users.* FROM trips INNER JOIN users ON trips.user_id = users.id ORDER BY destination_city ASC');
                    break;
                case 'dest_city_desc':
                    $query = $bd->prepare('SELECT trips.id AS tid, trips.user_id AS user, trips.created_at AS created, trips.*, users.* FROM trips INNER JOIN users ON trips.user_id = users.id ORDER BY destination_city DESC');
                    break;
                case 'dep_at_asc':
                    $query = $bd->prepare('SELECT trips.id AS tid, trips.user_id AS user, trips.created_at AS created, trips.*, users.* FROM trips INNER JOIN users ON trips.user_id = users.id ORDER BY departure_at ASC');
                    break;
                case 'dep_at_desc':
                    $query = $bd->prepare('SELECT trips.id AS tid, trips.user_id AS user, trips.created_at AS created, trips.*, users.* FROM trips INNER JOIN users ON trips.user_id = users.id ORDER BY departure_at DESC');
                    break;
                case 'arr_at_asc':
                    $query = $bd->prepare('SELECT trips.id AS tid, trips.user_id AS user, trips.created_at AS created, trips.*, users.* FROM trips INNER JOIN users ON trips.user_id = users.id ORDER BY arrival_at ASC');
                    break;
                case 'arr_at_desc':
                    $query = $bd->prepare('SELECT trips.id AS tid, trips.user_id AS user, trips.created_at AS created, trips.*, users.* FROM trips INNER JOIN users ON trips.user_id = users.id ORDER BY arrival_at DESC');
                    break;
                case 'dist_asc':
                    $query = $bd->prepare('SELECT trips.id AS tid, trips.user_id AS user, trips.created_at AS created, trips.*, users.* FROM trips INNER JOIN users ON trips.user_id = users.id ORDER BY distance ASC');
                    break;
                case 'dist_desc':
                    $query = $bd->prepare('SELECT trips.id AS tid, trips.user_id AS user, trips.created_at AS created, trips.*, users.* FROM trips INNER JOIN users ON trips.user_id = users.id ORDER BY distance DESC');
                    break;
                case 'crea_asc':
                    $query = $bd->prepare('SELECT trips.id AS tid, trips.user_id AS user, trips.created_at AS created, trips.*, users.* FROM trips INNER JOIN users ON trips.user_id = users.id ORDER BY created ASC');
                    break;
                case 'crea_desc':
                    $query = $bd->prepare('SELECT trips.id AS tid, trips.user_id AS user, trips.created_at AS created, trips.*, users.* FROM trips INNER JOIN users ON trips.user_id = users.id ORDER BY created DESC');
                    break;
                case 'driver_asc':
                    $query = $bd->prepare('SELECT trips.id AS tid, trips.user_id AS user, trips.created_at AS created, trips.*, users.* FROM trips INNER JOIN users ON trips.driver_id = users.id ORDER BY user_id ASC');
                    break;
                case 'driver_desc':
                    $query = $bd->prepare('SELECT trips.id AS tid, trips.user_id AS user, trips.created_at AS created, trips.*, users.* FROM trips INNER JOIN users ON trips.driver_id = users.id ORDER BY user_id DESC');
                    break;
            }
        }
    } else {
        $query = $bd->prepare('SELECT trips.id AS tid, trips.user_id AS user, trips.created_at AS created, trips.*, users.* FROM trips INNER JOIN users ON trips.user_id = users.id');
    }

    $query -> execute();
    $trips = $query->fetchAll();
?>

<section class="container">
<h1 class="center">Gestion des trajets</h1>
<?= isset($_SESSION['crudLog']) ? '<p>' . $_SESSION['crudLog'] . '</p>': '' ?>

<a href="create.php" class="btn green">Ajouter un trajet</a>

<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" style="margin: 64px 0 32px 0;">
    <label for="sort_by">Trier par :</label>
    <div class="form-group">
        <select name="sort_by" id="sort_by">
            <option value="id_asc">Identifiant (croissant)</option>
            <option value="id_desc">Identifiant (décroissant)</option>
            <option value="dep_city_asc">Ville de départ (croissant)</option>
            <option value="dep_city_desc">Ville de départ (décroissant)</option>
            <option value="dest_city_asc">Ville de destination (croissant)</option>
            <option value="dest_city_desc">Ville de destination (décroissant)</option>
            <option value="dep_at_asc">Heure de départ (croissant)</option>
            <option value="dep_at_desc">Heure de départ (décroissant)</option>
            <option value="arr_at_asc">Heure d'arrivée (croissant)</option>
            <option value="arr_at_desc">Heure d'arrivée (décroissant)</option>
            <option value="dist_asc">Distance (croissant)</option>
            <option value="dist_desc">Distance (décroissant)</option>
            <option value="crea_asc">Date de création (croissant)</option>
            <option value="crea_desc">Date de création (décroissant)</option>
            <option value="driver_asc">Conducteur (croissant)</option>
            <option value="driver_desc">Conducteur (décroissant)</option>
        </select>
    </div>
    <button type="submit">Trier</button>
</form>

<table border>
    <thead>
        <tr>
            <th>ID</th>
            <th>Ville de départ</th>
            <th>Adresse de départ</th>
            <th>Départ le</th>
            <th>Ville de destination</th>
            <th>Adresse de destination</th>
            <th>Arrivée le</th>
            <th>Distance</th>
            <th>Places</th>
            <th>ID conducteur</th>
            <th>Conducteur</th>
            <th>Date de création</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($trips as $trip): ?>
            <tr>
                <td><?= $trip['tid'] ?></td>
                <td><?= $trip['departure_city'] ?></td>
                <td><?= $trip['departure_address'] ?></td>
                <td><?= $trip['departure_at'] ?></td>
                <td><?= $trip['destination_city'] ?></td>
                <td><?= $trip['destination_address'] ?></td>
                <td><?= $trip['arrival_at'] ?></td>
                <td><?= $trip['distance'] ?></td>
                <td><?= $trip['seats'] ?></td>
                <td><?= $trip['user'] ?></td>
                <td><?= $trip['first_name'] . " " . $trip['last_name'] ?></td>
                <td><?= $trip['created'] ?></td>
                <th><a href="./modifications.php?id=<?= $trip['tid'] ?>">Modifier</a></th>
                <th><a href="delete.php?from=<?= basename($_SERVER['PHP_SELF']) ?>&id=<?= $trip['tid'] ?>">Supprimer</a></th>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</section>

<?php
    unset($_SESSION['crudLog']);
    dbDisconnect($bd);
?>