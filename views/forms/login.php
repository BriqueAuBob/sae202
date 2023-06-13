<h1>Connexion</h1>
<?= isset($_SESSION['error']) ? '<p class="message error">' . $_SESSION['error'] . '</p>' : '' ?>
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

<a class="mt-md" href="./inscription.php">Je n'ai pas encore de compte</a>
<?php unset($_SESSION['error']) ?>