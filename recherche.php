


<form action="/recherche_reponse.php" method="post">
    <label for="search">Rechercher un trajet</label>
    <input class="field" type="text" name="search" id="search" required/>

<?php
    if (isset($_GET['error_name'])){
        echo '<p>Veuillez remplir le champ.</p>';
    }
?>
    <button class="" type="submit">OK</button>
</form>