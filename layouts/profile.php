<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VrooMMI <?= isset($pageTitle) ? ' - ' . $pageTitle : '' ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://kit.fontawesome.com/1d20ef0596.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    require __DIR__ . '/../inc/lib.inc.php';

    require __DIR__ . '/../components/navbar.php';
    ?>

    <header class="small flex">
        <h1>Bonjour <?= $_SESSION['user']['firstname'] ?> !</h1>
        <?= isset($_SESSION['message']) ? '<p>' . $_SESSION['message'] . '</p>' : '' ?>
        <?= isset($_SESSION['error']) ? '<p class="message error">' . $_SESSION['error'] . '</p>' : '' ?>
    </header>
    <div class="overlap container">
        <div class="small">
            <ul class="grid cols-4 no-gap" id="profile_navigation">
                <?php
                $currentPage = basename($_SERVER['PHP_SELF']);
                ?>
                <li><a href="/profil/" <?= $currentPage === 'index.php' ? 'class="active"' : '' ?>><img src="/assets/images/icons/users.svg" />Mes paramètres</a></li>
                <li><a href="/profil/trajets.php" <?= $currentPage === 'trajets.php' ? 'class="active"' : '' ?>><img src="/assets/images/icons/users.svg" />Mes trajets</a></li>
                <li><a href="/profil/reservations.php" <?= $currentPage === 'reservations.php' ? 'class="active"' : '' ?>><img src="/assets/images/icons/users.svg" />Mes réservations</a></li>
                <li><a href="/profil/messages.php" <?= $currentPage === 'messages.php' ? 'class="active"' : '' ?>><img src="/assets/images/icons/users.svg" />Messages</a></li>
            </ul>
        </div>
    </div>

    <?php
    include __DIR__ . '/../views/' . $template . '.php';
    require __DIR__ . '/../components/footer.php';
    ?>

    <script src="/assets/js/script.js"></script>
</body>

</html>