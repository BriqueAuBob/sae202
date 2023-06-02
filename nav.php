<nav>
    <?php
    if (isset($_SESSION['firstname'])) {
        echo '<a href="deconnexion.php">Déconnexion</a>';
    } else {
        echo '<a href="connexion.php">Connexion</a>';
        echo '<a href="inscription.php">Inscription</a>';
    }
    ?>
</nav>