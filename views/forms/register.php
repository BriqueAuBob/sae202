<form method="post">
    <label for="first_name">Prénom :</label>
    <input type="text" id="first_name" name="first_name" placeholder="Patrice">

    <label for="last_name">Nom :</label>
    <input type="text" id="last_name" name="last_name" placeholder="Gommery">

    <label for="email">Adresse mail :</label>
    <input type="email" id="email" name="email" placeholder="exemple@domain.com">

    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password">

    <button class="btn green" type="submit">Créer mon compte</button>
</form>

<a href="./connexion.php">J'ai déjà un compte</a>

<?php
if (isset($_SESSION['error'])) {
    echo '<p>' . $_SESSION['error'] . '</p>';
    unset($_SESSION['error']);
} else if (isset($_SESSION['account'])) {
    echo '<p>' . $_SESSION['account'] . '</p>';
    unset($_SESSION['account']);
}
