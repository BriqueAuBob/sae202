<?php
require '../../inc/lib.inc.php';

$bd = dbConnect();

$id = $_GET['id'];

$query = $bd->prepare('DELETE FROM vehicles WHERE id = :id');
$query->execute([
    'id' => $id
]);

$_SESSION['crudLog'] = 'Le véhicule n°' . $id . ' a bien été supprimé !';


dbDisconnect($bd);
header('Location: ./');
