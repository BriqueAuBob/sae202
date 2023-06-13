<?php
    require 'inc/lib.inc.php';

    $db = dbConnect();

    if(empty($_POST['departure_city']) || empty($_POST['departure_address']) || empty($_POST['departure_date']) || empty($_POST['destination_city']) || empty($_POST['destination_address'])) {
        echo 'Veuillez remplir tous les champs !';
        header('Location: trajets.php');
        die();
    }

    $user_id = $_SESSION['user']['id'];

    if(strlen($_POST['departure_city']) > 50 || strlen($_POST['destination_city']) > 50) {
        $_SESSION['tripLog'] = 'Le nom des villes doivent contenir au maximum 50 caractères !';
        header('Location: trajets.php');
        die();
    }
    $departure_city = htmlspecialchars(ucwords(strtolower($_POST['departure_city'])));
    $destination_city = htmlspecialchars(ucwords(strtolower($_POST['destination_city'])));

    if(strlen($_POST['departure_address']) > 100 || strlen($_POST['destination_address']) > 100) {
        $_SESSION['tripLog'] = 'Les adresses doivent contenir au maximum 100 caractères !';
        header('Location: trajets.php');
        die();
    }
    $departure_address = htmlspecialchars($_POST['departure_address']);
    $destination_address = htmlspecialchars($_POST['destination_address']);

    $departure_date = $_POST['departure_date'];
    $arrival_at = date('Y-m-d H:i', strtotime("$departure_date + 1 hour"));

    $seats = (int)$_POST['seats'];

    $query = $db->prepare('SELECT id FROM vehicles WHERE user_id = :user_id');
    $query -> execute([
        'user_id' => $user_id
    ]);
    $vehicle = $query->fetch();

    $query = $db->prepare('INSERT INTO trips (user_id, vehicle_id, departure_city, departure_address, departure_at, destination_city, destination_address, arrival_at, seats) VALUES (:user_id, :vehicle_id, :departure_city, :departure_address, :departure_date, :destination_city, :destination_address, :arrival_at, :seats)');
    $query -> execute([
        'user_id' => $user_id,
        'vehicle_id' => $vehicle['id'],
        'departure_city' => $departure_city,
        'departure_address' => $departure_address,
        'departure_date' => $departure_date,
        'destination_city' => $destination_city,
        'destination_address' => $destination_address,
        'arrival_at' => $arrival_at,
        'seats' => $seats
    ]);

    dbDisconnect($db);
    
    $_SESSION['message'] = 'Votre trajet a bien été publié !';
    header('Location: trajets.php');
?>