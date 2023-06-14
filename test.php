<?php
    require 'inc/lib.inc.php';
    $departure_address = '11 rue des Varennes';
    $departure_city = 'Saint-Maur-des-Fossés';
    $destination_address = '1 rue Montigny';
    $destination_city = 'Dijon';
    $distance = distance($departure_address . ", " . $departure_city, $destination_address . ", " . $destination_city);
    echo $distance;
?>