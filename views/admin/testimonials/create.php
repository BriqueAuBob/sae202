<section class="container">
    <h1 class="center">Ajouter un avis</h1>

    <?= isset($_SESSION['crudLog']) ? '<p>' . $_SESSION['crudLog'] . '</p>' : '' ?>

    <form action="./create.php" method="post">
        <section class="form container">
            <div class="form-group">
                <div>
                    <label for="stars">Nombre d'étoiles</label>
                    <input type="number" name="stars" id="stars" min="0" max="5" placeholder="Nombre d'étoiles">
                </div>
                <div>
                    <label for="type">Type</label>
                    <input type="number" name="type" id="type" min="0" placeholder="type">
                </div>
            </div>
            <div>
                <label for="content">Contenu</label>
                <input type="text" name="content" id="content" rows="1"></textarea>
            </div>
            <div class="form-group">
                <?php
                    $db = dbConnect();

                    $query = $db->query('SELECT * FROM users');
                    $users = $query->fetchAll();
                ?>
                <select name="user" id="user">
                    <?php foreach($users as $user): ?>
                        <option value="<?= $user['id'] ?>"><?= $user['first_name'] . ' ' . $user['last_name'] ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="author" id="author">
                    <?php foreach($users as $author): ?>
                        <option value="<?= $author['id'] ?>"><?= $author['first_name'] . ' ' . $author['last_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button class="btn green" type="submit">Valider l'ajout</button>
        </section>
    </form>
</section>

<?php
    unset($_SESSION['crudLog']);
?>