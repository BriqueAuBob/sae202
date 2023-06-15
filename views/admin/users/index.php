<?php
    $bd = dbConnect();

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['sort_by'])) {
            switch($_POST['sort_by']) {
                case 'id_asc':
                    $query = $bd->prepare('SELECT * FROM users ORDER BY id ASC');
                    break;
                case 'id_desc':
                    $query = $bd->prepare('SELECT * FROM users ORDER BY id DESC');
                    break;
                case 'name_asc':
                    $query = $bd->prepare('SELECT * FROM users ORDER BY last_name ASC');
                    break;
                case 'name_desc':
                    $query = $bd->prepare('SELECT * FROM users ORDER BY last_name DESC');
                    break;
                case 'firstname_asc':
                    $query = $bd->prepare('SELECT * FROM users ORDER BY first_name ASC');
                    break;
                case 'firstname_desc':
                    $query = $bd->prepare('SELECT * FROM users ORDER BY first_name DESC');
                    break;
                case 'created_at_asc':
                    $query = $bd->prepare('SELECT * FROM users ORDER BY created_at ASC');
                    break;
                case 'created_at_desc':
                    $query = $bd->prepare('SELECT * FROM users ORDER BY created_at DESC');
                    break;
                default:
                    $query = $bd->prepare('SELECT * FROM users');
                    break;
            }
        }
    }

    $query->execute();
    $users = $query->fetchAll();
?>

<h1>Gestion des utilisateurs</h1>
<?= isset($_SESSION['crudLog']) ? '<p>' . $_SESSION['crudLog'] . '</p>' : '' ?>

<a href="create.php" class="btn green">Ajouter un utilisateur</a>

<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
    <label for="sort_by">Trier par :</label>
    <select name="sort_by" id="sort_by">
        <option value="id_asc">Identifiant (croissant)</option>
        <option value="id_desc">Identifiant (décroissant)</option>
        <option value="name_asc">Nom de famille (croissant)</option>
        <option value="name_desc">Nom de famille (décroissant)</option>
        <option value="firstname_asc">Prénom (croissant)</option>
        <option value="firstname_desc">Prénom (décroissant)</option>
        <option value="created_at_asc">Date de création (croissant)</option>
        <option value="created_at_desc">Date de création (décroissant)</option>
    </select>
    <button type="submit">Trier</button>
</form>

<table border>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Photo de profil</th>
            <th>Adresse mail</th>
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