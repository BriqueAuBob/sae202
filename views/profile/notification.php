<?php
$db = dbConnect();
$query = $db->prepare('SELECT * FROM notifications WHERE user_id = :user_id ORDER BY created_at DESC');
$query->execute([
    ':user_id' => $_SESSION['user']['id']
]);
$count = $query->rowCount();
$notifications = $query->fetchAll();
?>
<header class="small">
    <h1>Mes Notifications</h1>
</header>
<section class="container">
    <ul class="notifications">
        <?php
        foreach ($notifications as $notification) {
            displayNotification(NotificationType::from($notification['type']), $notification['content'], date('d/m à H\hi', strtotime($notification['created_at'])), $notification['id'], $notification['readed']);
        }
        ?>
    </ul>
</section>