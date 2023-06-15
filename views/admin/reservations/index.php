<?php
    $bd = dbConnect();

    $query = $bd->prepare('SELECT reservations.user_id AS user, reservations.trip_id AS trip, reservations.*, users.id AS user_id, users.*, trips.id AS trip_id, trips.* FROM reservations INNER JOIN users ON reservations.user_id = users.id INNER JOIN trips ON reservations.trip_id = trips.id');

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['sort_by'])) {
            switch($_POST['sort_by']) {
                case 'user_id_asc':
                    $query = $bd->prepare('SELECT reservations.user_id AS user, reservations.trip_id AS trip, reservations.*, users.id AS user_id, users.*, trips.id AS trip_id, trips.* FROM reservations INNER JOIN users ON reservations.user_id = users.id INNER JOIN trips ON reservations.trip_id = trips.id ORDER BY reservations.user_id ASC');
                    break;
                case 'user_id_desc':
                    $query = $bd->prepare('SELECT reservations.user_id AS user, reservations.trip_id AS trip, reservations.*, users.id AS user_id, users.*, trips.id AS trip_id, trips.* FROM reservations INNER JOIN users ON reservations.user_id = users.id INNER JOIN trips ON reservations.trip_id = trips.id ORDER BY reservations.user_id DESC');
                    break;
                case 'trip_id_asc':
                    $query = $bd->prepare('SELECT reservations.user_id AS user, reservations.trip_id AS trip, reservations.*, users.id AS user_id, users.*, trips.id AS trip_id, trips.* FROM reservations INNER JOIN users ON reservations.user_id = users.id INNER JOIN trips ON reservations.trip_id = trips.id ORDER BY reservations.trip_id ASC');
                    break;
                case 'trip_id_desc':
                    $query = $bd->prepare('SELECT reservations.user_id AS user, reservations.trip_id AS trip, reservations.*, users.id AS user_id, users.*, trips.id AS trip_id, trips.* FROM reservations INNER JOIN users ON reservations.user_id = users.id INNER JOIN trips ON reservations.trip_id = trips.id ORDER BY reservations.trip_id DESC');
                    break;
                default:
                    $query = $bd->prepare('SELECT reservations.user_id AS user, reservations.trip_id AS trip, reservations.*, users.id AS user_id, users.*, trips.id AS trip_id, trips.* FROM reservations INNER JOIN users ON reservations.user_id = users.id INNER JOIN trips ON reservations.trip_id = trips.id');
                    break;
            }
        }
    }

    $query->execute();
    $reservations = $query->fetchAll();
?>

<h1>Gestion des réservations</h1>
<?= isset($_SESSION['crudLog']) ? '<p>' . $_SESSION['crudLog'] . '</p>' : '' ?>

<a href="create.php" class="btn green">Ajouter une réservation</a>

<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
    <label for="sort_by">Trier par :</label>
    <select name="sort_by" id="sort_by">
        <option value="user_id_asc">Identifiant utilisateur (croissant)</option>
        <option value="user_id_desc">Identifiant utilisateur (décroissant)</option>
        <option value="trip_id_asc">Identifiant trajet (croissant)</option>
        <option value="trip_id_desc">Identifiant trajet (décroissant)</option>
    </select>
    <button type="submit">Trier</button>
</form>

<table border>
    <thead>
        <tr>
            <th>Identifiant utilisateur</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Identifiant trajet</th>
            <th>Départ</th>
            <th>Arrivée</th>
            <th>Date de départ</th>
            <th>Date d'arrivée</th>
            <th>Date de création</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reservations as $reservation) : ?>
            <tr>
                <td><?= $reservation['user'] ?></td>
                <td><?= $reservation['last_name'] ?></td>
                <td><?= $reservation['first_name'] ?></td>
                <td><?= $reservation['trip'] ?></td>
                <td><?= $reservation['departure_address'] . ", " . $reservation['departure_city'] ?></td>
                <td><?= $reservation['destination_address'] . ", " . $reservation['destination_city'] ?></td>
                <td><?= $reservation['departure_at'] ?></td>
                <td><?= $reservation['arrival_at'] ?></td>
                <td><?= $reservation['created_at'] ?></td>
                <th><a href="modifications.php?user_id=<?= $reservation['user'] ?>&trip_id=<?= $reservation['trip'] ?>">Modifier</a></th>
                <th><a href="delete.php?from=<?= basename($_SERVER['PHP_SELF']) ?>&user_id=<?= $reservation['user'] ?>&trip_id=<?= $reservation['trip'] ?>">Supprimer</a></th>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
$_SESSION['crudLog'] = '';
dbDisconnect($bd);
?>