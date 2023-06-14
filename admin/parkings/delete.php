<?php
require '../../inc/lib.inc.php';

$bd = dbConnect();

$id = $_GET['id'];

$query = $bd->prepare('DELETE FROM parkings WHERE id = :id');
$query->execute([
    'id' => $id
]);

$_SESSION['crudLog'] = 'Le parking n°' . $id . ' a bien été supprimé !';


dbDisconnect($bd);
header('Location: ./');
