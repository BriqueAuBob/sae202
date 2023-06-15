<?php
require '../../inc/lib.inc.php';

$bd = dbConnect();

$user_id = $_GET['user_id'];
$trip_id = $_GET['trip_id'];

$query = $bd->prepare('DELETE FROM reservations WHERE user_id = :user_id AND trip_id = :trip_id');
$query -> execute([
    ':user_id' => $user_id,
    ':trip_id' => $trip_id
]);

$_SESSION['crudLog'] = 'La réservation de l\'utilisateur n°' . $user_id . ' pour le trajet n°' . $trip_id . ' a bien été supprimé !';


dbDisconnect($bd);
header('Location: ./');
