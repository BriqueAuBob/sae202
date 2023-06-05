<h1>Connexion</h1>
<form method="post">
    <div>
        <label for="email">Email :</label>
        <input type="email" name="email" id="email">
    </div>
    <div>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password">
    </div>
    <button class="btn green" type=" submit">Se connecter</button>
</form>

<a href="./inscription.php">Je n'ai pas encore de compte</a>

<?php
if (isset($_SESSION['error'])) {
    echo '<p>' . $_SESSION['error'] . '</p>';
    unset($_SESSION['error']);
}
?>