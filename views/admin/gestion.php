<?php
    $bd = dbConnect();

    $query = $bd -> prepare('SELECT COUNT(*) AS registered FROM users');
    $query -> execute();
    $registered = $query -> fetch()['registered'];
?>

<p>Nombre d'utilisateurs inscrits : <?= $registered ?></p>

<?php
    $query = $bd -> prepare('SELECT COUNT(*) AS trips FROM trips');
    $query -> execute();
    $trips = $query -> fetch()['trips'];
?>

<p>Nombre de trajets ayant existé : <?= $trips ?></p>