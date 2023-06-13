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
?>
<div class="popover-wrapper">
    <button class="no-style badge">
        <img src="/assets/images/icons/bell.svg" alt="Bell icon">
        <span>3</span>
    </button>
    <div class="popover">
        <ul class="notifications">
            <?php
            displayNotification(NotificationType::SUCCESS, 'Vous avez une nouvelle réservation pour votre trajet de la part de Melvil.');
            displayNotification(NotificationType::ERROR, 'Jade a annulé sa réservation.');
            displayNotification(NotificationType::INFO, 'Cassandre vous a envoyé un message.');
            ?>
            <li class="mt-sm"><a href="#">Voir toutes les notifications</a></li>
        </ul>
    </div>
</div>