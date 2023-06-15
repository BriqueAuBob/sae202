<?php
    $bd = dbConnect();

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['sort_by'])) {
            switch($_POST['sort_by']) {
                case 'id_asc':
                    $query = $bd->prepare('SELECT testimonials.id AS tid, testimonials.created_at AS date, testimonials.*, users.last_name as user_name, users.first_name AS user_firstname, author.last_name AS author_name, author.first_name AS author_firstname FROM testimonials INNER JOIN users ON testimonials.user_id = users.id INNER JOIN users AS author ON testimonials.author_id = author.id ORDER BY testimonials.id ASC');
                    break;
                case 'id_desc':
                    $query = $bd->prepare('SELECT testimonials.id AS tid, testimonials.created_at AS date, testimonials.*, users.last_name as user_name, users.first_name AS user_firstname, author.last_name AS author_name, author.first_name AS author_firstname FROM testimonials INNER JOIN users ON testimonials.user_id = users.id INNER JOIN users AS author ON testimonials.author_id = author.id ORDER BY testimonials.id DESC');
                    break;
                case 'stars_asc':
                    $query = $bd->prepare('SELECT testimonials.id AS tid, testimonials.created_at AS date, testimonials.*, users.last_name as user_name, users.first_name AS user_firstname, author.last_name AS author_name, author.first_name AS author_firstname FROM testimonials INNER JOIN users ON testimonials.user_id = users.id INNER JOIN users AS author ON testimonials.author_id = author.id ORDER BY testimonials.stars ASC');
                    break;
                case 'stars_desc':
                    $query = $bd->prepare('SELECT testimonials.id AS tid, testimonials.created_at AS date, testimonials.*, users.last_name as user_name, users.first_name AS user_firstname, author.last_name AS author_name, author.first_name AS author_firstname FROM testimonials INNER JOIN users ON testimonials.user_id = users.id INNER JOIN users AS author ON testimonials.author_id = author.id ORDER BY testimonials.stars DESC');
                    break;
                case 'user_asc':
                    $query = $bd->prepare('SELECT testimonials.id AS tid, testimonials.created_at AS date, testimonials.*, users.last_name as user_name, users.first_name AS user_firstname, author.last_name AS author_name, author.first_name AS author_firstname FROM testimonials INNER JOIN users ON testimonials.user_id = users.id INNER JOIN users AS author ON testimonials.author_id = author.id ORDER BY users.id ASC');
                    break;
                case 'user_desc':
                    $query = $bd->prepare('SELECT testimonials.id AS tid, testimonials.created_at AS date, testimonials.*, users.last_name as user_name, users.first_name AS user_firstname, author.last_name AS author_name, author.first_name AS author_firstname FROM testimonials INNER JOIN users ON testimonials.user_id = users.id INNER JOIN users AS author ON testimonials.author_id = author.id ORDER BY users.id DESC');
                    break;
                case 'author_asc':
                    $query = $bd->prepare('SELECT testimonials.id AS tid, testimonials.created_at AS date, testimonials.*, users.last_name as user_name, users.first_name AS user_firstname, author.last_name AS author_name, author.first_name AS author_firstname FROM testimonials INNER JOIN users ON testimonials.user_id = users.id INNER JOIN users AS author ON testimonials.author_id = author.id ORDER BY author.id ASC');
                    break;
                case 'author_desc':
                    $query = $bd->prepare('SELECT testimonials.id AS tid, testimonials.created_at AS date, testimonials.*, users.last_name as user_name, users.first_name AS user_firstname, author.last_name AS author_name, author.first_name AS author_firstname FROM testimonials INNER JOIN users ON testimonials.user_id = users.id INNER JOIN users AS author ON testimonials.author_id = author.id ORDER BY author.id DESC');
                    break;
                case 'created_at_asc':
                    $query = $bd->prepare('SELECT testimonials.id AS tid, testimonials.created_at AS date, testimonials.*, users.last_name as user_name, users.first_name AS user_firstname, author.last_name AS author_name, author.first_name AS author_firstname FROM testimonials INNER JOIN users ON testimonials.user_id = users.id INNER JOIN users AS author ON testimonials.author_id = author.id ORDER BY testimonials.created_at ASC');
                    break;
                case 'created_at_desc':
                    $query = $bd->prepare('SELECT testimonials.id AS tid, testimonials.created_at AS date, testimonials.*, users.last_name as user_name, users.first_name AS user_firstname, author.last_name AS author_name, author.first_name AS author_firstname FROM testimonials INNER JOIN users ON testimonials.user_id = users.id INNER JOIN users AS author ON testimonials.author_id = author.id ORDER BY testimonials.created_at DESC');
                    break;
                default:
                    $query = $bd->prepare('SELECT testimonials.id AS tid, testimonials.created_at AS date, testimonials.*, users.last_name as user_name, users.first_name AS user_firstname, author.last_name AS author_name, author.first_name AS author_firstname FROM testimonials INNER JOIN users ON testimonials.user_id = users.id INNER JOIN users AS author ON testimonials.author_id = author.id');
                    break;
            }
        }
    } else {
        $query = $bd->prepare('SELECT testimonials.id AS tid, testimonials.created_at AS date, testimonials.*, users.last_name as user_name, users.first_name AS user_firstname, author.last_name AS author_name, author.first_name AS author_firstname FROM testimonials INNER JOIN users ON testimonials.user_id = users.id INNER JOIN users AS author ON testimonials.author_id = author.id');
    }

    $query->execute();
    $testimonials = $query->fetchAll();
?>

<section class="container">
    <h1 class="center">Gestion des avis</h1>
    <?= isset($_SESSION['crudLog']) ? '<p>' . $_SESSION['crudLog'] . '</p>' : '' ?>

    <a href="create.php" class="btn green">Ajouter un avis</a>

    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" style="margin: 64px 0 32px 0;">
        <label for="sort_by">Trier par :</label>
        <div class="form-group">
            <select name="sort_by" id="sort_by">
                <option value="id_asc">Identifiant (croissant)</option>
                <option value="id_desc">Identifiant (décroissant)</option>
                <option value="stars_asc">Nombre d'étoiles (croissant)</option>
                <option value="stars_desc">Nombre d'étoiles (décroissant)</option>
                <option value="user_asc">Destinataire (croissant)</option>
                <option value="user_desc">Destinataire (décroissant)</option>
                <option value="author_asc">Auteur (croissant)</option>
                <option value="author_desc">Auteur (décroissant)</option>
                <option value="created_at_asc">Date de création (croissant)</option>
                <option value="created_at_desc">Date de création (décroissant)</option>
            </select>
        </div>
        <button type="submit">Trier</button>
    </form>

    <table border>
        <thead>
            <tr>
                <th>Identifiant</th>
                <th>Nombre d'étoiles</th>
                <th>Contenu</th>
                <th>Type</th>
                <th>Identifiant destinataire</th>
                <th>Destinataire</th>
                <th>Identifiant auteur</th>
                <th>Auteur</th>
                <th>Date de création</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($testimonials as $testimonial) : ?>
                <tr>
                    <td><?= $testimonial['id'] ?></td>
                    <td><?= $testimonial['stars'] ?></td>
                    <td><?= $testimonial['content'] ?></td>
                    <td><?= $testimonial['type'] ?></td>
                    <td><?= $testimonial['user_id'] ?></td>
                    <td><?= $testimonial['user_firstname'] . ' ' . $testimonial['user_name'] ?></td>
                    <td><?= $testimonial['author_id'] ?></td>
                    <td><?= $testimonial['author_firstname'] . ' ' . $testimonial['author_name'] ?></td>
                    <td><?= $testimonial['date'] ?></td>

                    <th><a href="modifications.php?id=<?= $testimonial['tid'] ?>">Modifier</a></th>
                    <th><a href="delete.php?from=<?= basename($_SERVER['PHP_SELF']) ?>&id=<?= $testimonial['tid'] ?>">Supprimer</a></th>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<?php
$_SESSION['crudLog'] = '';
dbDisconnect($bd);
?>