<?php 
require "head.php";
require "nav.php";
?>

<h1>Connexion</h1>
<form action="connexion_verif.php" method="post">
    <div>
        <label for="email">Email :</label>
        <input type="email" name="email" id="email">
    </div>
    <div>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password">
    </div>
    <div>
        <input type="submit" value="Se connecter">
    </div>
</form>

<?php require 'tail.php';?>