<?php
$db = dbConnect();
$query = $db->prepare('SELECT * FROM notifications WHERE user_id = :user_id ORDER BY created_at DESC');
$query->execute([
    ':user_id' => $_SESSION['user']['id']
]);
$count = $query->rowCount();
$notifications = $query->fetchAll();
?>
<div class="popover-wrapper">
    <button class="no-style badge">
        <img src="/assets/images/icons/bell.svg" alt="Bell icon">
        <span><?= $count ?></span>
    </button>
    <div class="popover">
        <ul class="notifications">
            <?php
            foreach ($notifications as $notification) {
                displayNotification(NotificationType::from($notification['type']), $notification['content']);
            }
            ?>
            <li class="mt-sm"><a href="/profil/notifications.php">Voir toutes les notifications</a></li>
        </ul>
    </div>
</div>