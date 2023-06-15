<!-- <nav>
    <ul>
        <li><a href="/admin/index.php">Home</a></li>
        <li><a href="/admin/parkings">Parkings</a></li>
        <li><a href="/admin/users">Utilisateurs</a></li>
        <li><a href="/admin/vehicles">Véhicules</a></li>
    </ul>
</nav> -->

<?php
$currentPage = $_SERVER['PHP_SELF'];
?>
<nav class="container hidden">
    <div class="wrapper" style="justify-content: center;">
        <ul>
        <li><a <?= $currentPage === '/admin/index.php' ? 'class="active"' : '' ?> href="/admin">Panel</a></li>
            <li><a <?= $currentPage === '/admin/users/index.php' ? 'class="active"' : '' ?> href="/admin/users">Utilisateurs</a></li>
            <li><a <?= $currentPage === '/admin/vehicles/index.php' ? 'class="active"' : '' ?> href="/admin/vehicles">Véhicules</a></li>
            <li><a <?= $currentPage === '/admin/trips/index.php' ? 'class="active"' : '' ?> href="/admin/trips">Trajets</a></li>
            <li><a <?= $currentPage === '/admin/reservations/index.php' ? 'class="active"' : '' ?> href="/admin/reservations">Réservations</a></li>
            <li><a <?= $currentPage === '/admin/testimonials/index.php' ? 'class="active"' : '' ?> href="/admin/testimonials">Avis</a></li>
            <li><a <?= $currentPage === '/admin/parkings/index.php' ? 'class="active"' : '' ?> href="/admin/parkings">Parkings</a></li>
            <li><a <?= $currentPage === '/index.php' ? 'class="active"' : '' ?> href="/" style="color: #F44;">Retour au site</a></li>
        </ul>
    </div>
    <button id="menu-mobile-button" class=" no-style burger_icon">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
    </button>
</nav>

<script src="../../assets/js/script.js"></script>