<?php require 'head.php'; ?>

<form action="inscription_verif.php" method="post">
    <label for="first_name">Prénom :</label>
    <input type="text" id="first_name" name="first_name" placeholder="John">

    <label for="last_name">Prénom :</label>
    <input type="text" id="last_name" name="last_name" placeholder="Doe">

    <label for="email">Adresse mail :</label>
    <input type="text" id="email" name="email" placeholder="exemple@domain.com">

    <label for="pwd">Mot de passe :</label>
    <input type="password" id="pwd" name="pwd">

    <input type="submit" value="Valider">
</form>

<?php require "tail.php"; ?>