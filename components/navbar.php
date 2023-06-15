<?php
$currentPage = $_SERVER['PHP_SELF'];
?>
<nav class="navbar container hidden">
    <a class="branding" href="/"><img src="/assets/images/logo_white.svg" alt="Logo White VrooMMI"></a>
    <div class="wrapper">
        <ul>
            <li><a <?= $currentPage === '/index.php' ? 'class="active"' : '' ?> href="/">Accueil</a></li>
            <li><a <?= $currentPage === '/trajets.php' ? 'class="active"' : '' ?> href="/trajets.php">Trajets</a></li>
            <li><a <?= $currentPage === '/parkings.php' ? 'class="active"' : '' ?> href="/parkings.php">Parkings</a></li>
            <li><a <?= $currentPage === '/contact.php' ? 'class="active"' : '' ?> href="/contact.php">Contact</a></li>
        </ul>
    </div>
    <div class="btn-list">
        <button class="no-style" id="dark-mode-toggle"><img src="/assets/images/icons/moon.svg" alt="Moon icon"></button>
        <?php
        if (isset($_SESSION['user']['id'])) {
            include(__DIR__ . '/notifications.php');
            echo '<a href="/profil" id="profile"><img src="/assets/images/avatars/' . $_SESSION['user']['picture'] . '" alt="Avatar">' . $_SESSION['user']['firstname'] . '</a>';
        } else {
            echo '<a href="/connexion.php" class="btn">Accéder à mon compte</a>';
        }
        ?>
    </div>
    <button id="menu-mobile-button" class=" no-style burger_icon"><img src="/assets/images/icons/burger.svg" /></button>
</nav>