<?php
    require 'inc/lib.inc.php';

    if(empty($_POST['departure_city']) || empty($_POST['departure_address']) || empty($_POST['departure_date']) || empty($_POST['destination_city']) || empty($_POST['destination_address'])) {
        echo 'Veuillez remplir tous les champs !';
        header('Location: trajets.php');
        die();
    }

    $db = dbConnect();

    $user_id = $_SESSION['user_id'];
    $departure_city = htmlspecialchars(ucwords(strtolower($_POST['departure_city'])));
    $departure_address = htmlspecialchars($_POST['departure_address']);
    $departure_date = $_POST['departure_date'];
    $destination_city = htmlspecialchars(ucwords(strtolower($_POST['destination_city'])));
    $destination_address = htmlspecialchars($_POST['destination_address']);
    $arrival_at = date('Y-m-d H:i', strtotime("$departure_date + 1 hour"));

    $query = $db -> prepare('INSERT INTO trips (user_id, departure_city, departure_address, departure_at, destination_city, destination_address, arrival_at, created_at) VALUES (:user_id, :departure_city, :departure_address, :departure_at, :destination_city, :destination_address, :arrival_at, NOW())');
    $query -> execute([
        'user_id' => $user_id,
        'departure_city' => $departure_city,
        'departure_address' => $departure_address,
        'departure_at' => $departure_date,
        'destination_city' => $destination_city,
        'destination_address' => $destination_address,
        'arrival_at' => $arrival_at
    ]);
    
    $_SESSION['message'] = 'Votre trajet a bien été publié !';
    header('Location: trajets.php');
?>