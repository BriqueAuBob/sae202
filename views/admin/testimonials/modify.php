<?php
    $bd = dbConnect();
    $id = $_GET['id'];

    $query = $bd->prepare('SELECT testimonials.id AS tid, testimonials.created_at AS date, testimonials.*, users.last_name as user_name, users.first_name AS user_firstname, author.last_name AS author_name, author.first_name AS author_firstname FROM testimonials INNER JOIN users ON testimonials.user_id = users.id INNER JOIN users AS author ON testimonials.author_id = author.id WHERE testimonials.id = :tid');
    $query->execute(array(
        'tid' => $id
    ));
    $testimonial = $query->fetch();
?>

<section class="container">
    <h1 class="center">Modification de l'avis</h1>
<form action="./modifications.php" method="post">
    <section class="form container">
        <input type="hidden" name="id" value="<?= $testimonial['id'] ?>">
        <div class="form-group">
            <div>
                <label for="stars">Nombre d'étoiles</label>
                <input type="number" name="stars" id="stars" min="0" max="5" placeholder="Nombre d'étoiles" value="<?= $testimonial['stars'] ?>">
            </div>
            <div>
                <label for="type">Type</label>
                <input type="number" name="type" id="type" min="0" placeholder="type" value="<?= $testimonial['type'] ?>">
            </div>
        </div>
        <div>
            <label for="content">Contenu</label>
            <input type="text" name="content" id="content" rows="1" value="<?= $testimonial['content'] ?>">
        </div>
        <div class="form-group">
            <?php
                $db = dbConnect();

                $query = $db->query('SELECT * FROM users');
                $users = $query->fetchAll();
            ?>
            <select name="user" id="user">
                <?php foreach($users as $user): ?>
                    <?php if($user['id'] == $testimonial['user_id']) : ?>
                        <option value="<?= $user['id'] ?>" selected><?= $user['first_name'] . ' ' . $user['last_name'] ?></option>
                    <?php else : ?>
                        <option value="<?= $user['id'] ?>"><?= $user['first_name'] . ' ' . $user['last_name'] ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
            <select name="author" id="author">
                <?php foreach($users as $author): ?>
                    <?php if($author['id'] == $testimonial['author_id']) : ?>
                        <option value="<?= $author['id'] ?>" selected><?= $author['first_name'] . ' ' . $author['last_name'] ?></option>
                    <?php else : ?>
                        <option value="<?= $author['id'] ?>"><?= $author['first_name'] . ' ' . $author['last_name'] ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>

        <button class="btn green" type="submit">Valider la modification</button>
    </section>
</form>
</section>

<?php
    unset($_SESSION['crudLog']);
    dbDisconnect($bd);
?>