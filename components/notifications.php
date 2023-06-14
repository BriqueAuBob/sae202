<?php
enum NotificationType: string
{
    case SUCCESS = 'success';
    case ERROR = 'error';
    case INFO = 'info';
}

function displayNotification(NotificationType $type, $message)
{
    $icon = match ($type) {
        NotificationType::SUCCESS => 'check',
        NotificationType::ERROR => 'cross',
        NotificationType::INFO => 'info',
    };
    echo '<li class="notification ' . $type->value . '">
    <a href="#">
        <img src="/assets/images/icons/' . $icon . '.svg" alt="Check icon">
        <p>' . $message . '</p>
    </a>
</li>';
}

$db = dbConnect();
$query = $db->prepare('SELECT * FROM notifications WHERE user_id = :user_id ORDER BY created_at ASC');
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
            /* displayNotification(NotificationType::SUCCESS, 'Vous avez une nouvelle réservation pour votre trajet de la part de Melvil.');
            displayNotification(NotificationType::ERROR, 'Jade a annulé sa réservation.');
            displayNotification(NotificationType::INFO, 'Cassandre vous a envoyé un message.'); */

            foreach ($notifications as $notification) {
                displayNotification(NotificationType::from($notification['type']), $notification['content']);
            }
            ?>
            <li class="mt-sm"><a href="#">Voir toutes les notifications</a></li>
        </ul>
    </div>
</div>