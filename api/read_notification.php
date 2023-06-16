<?php

require '../inc/lib.inc.php';

$db = dbConnect();

echo 'ok';
$id = $_GET['id'] ?? null;
if (!$id) {
    echo json_encode([
        'success' => false,
        'message' => 'Missing id'
    ]);
    exit;
}

$query = $db->prepare('SELECT * FROM notifications WHERE id = :id');
$query->execute([
    ':id' => $id
]);
$notification = $query->fetch(PDO::FETCH_ASSOC);

if (!$notification) {
    echo json_encode([
        'success' => false,
        'message' => 'Notification not found'
    ]);
    exit;
}

$user = $_SESSION['user'] ?? null;
if (!$user) {
    echo json_encode([
        'success' => false,
        'message' => 'User not found'
    ]);
    exit;
}

if ($notification['user_id'] != $user['id']) {
    echo json_encode([
        'success' => false,
        'message' => 'Notification not found'
    ]);
    exit;
}

$query = $db->prepare('UPDATE notifications SET readed = 1 WHERE id = :id');
$query->execute([
    ':id' => $id
]);

echo json_encode([
    'success' => true
]);

dbDisconnect($db);
