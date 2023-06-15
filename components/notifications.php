<?php
$db = dbConnect();
$query = $db->prepare('SELECT * FROM notifications WHERE user_id = :user_id ORDER BY created_at DESC LIMIT 4');
$query->execute([
    ':user_id' => $_SESSION['user']['id']
]);
$count = $query->rowCount();
$notifications = $query->fetchAll();
?>
<div class="popover-wrapper">
    <button class="no-style badge">
        <img src="/assets/images/icons/bell.svg" alt="Bell icon">
        <span><?= $count > 3 ? '3+' : $count ?></span>
    </button>
    <div class="popover">
        <ul class="notifications">
            <?php
            $i = 0;
            foreach ($notifications as $notification) {
                if ($i >= 3) break;
                displayNotification(NotificationType::from($notification['type']), $notification['content']);
                $i++;
            }
            ?>
            <li class="mt-sm"><a href="/profil/notifications.php">Voir toutes les notifications</a></li>
        </ul>
    </div>
</div>