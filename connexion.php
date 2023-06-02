<?php 
require "head.php";
require "nav.php";
?>

<body>
    <div>
        <h1>Connexion</h1>
        <form action="connexion.php" method="post">
            <div>
                <label for="email">Email :</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div>
                <label for="password">Mot de passe :</label>
                <input type="password" name="pwd" id="pwd" required>
            </div>
            <div>
                <input type="submit" value="Se connecter">
            </div>
        </form>
        <?php
            if (isset($_SESSION['erreur'])) {
                echo $_SESSION['erreur'];
                unset($_SESSION['erreur']);
            }
            //var_dump($_SESSION);
        ?>
    </div>
</body>
