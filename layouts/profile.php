<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VrooMMI <?= isset($pageTitle) ? ' - ' . $pageTitle : '' ?></title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="https://kit.fontawesome.com/1d20ef0596.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    require __DIR__ . '/../inc/lib.inc.php';

    require __DIR__ . '/../components/navbar.php';
    ?>

    <header class="small">
        <h1>Bonjour <?= $_SESSION['user']['firstname'] ?> !</h1>
        <div class="avatar huge center upload_input">
            <img class="avatar full" src="assets/images/avatars/<?= $_SESSION['user']['picture'] ?>" alt="Profile picture">
            <input type="file" name="picture" id="picture">
            <div class="gradient rounded_full">
                Modifier
            </div>
        </div>
        <?= isset($_SESSION['message']) ? '<p>' . $_SESSION['message'] . '</p>' : '' ?>
        <?= isset($_SESSION['error']) ? '<p class="message error">' . $_SESSION['error'] . '</p>' : '' ?>
    </header>
    <div class="overlap container">
        <div class="small">
            <ul class="grid cols-4" id="profile_navigation">
                <li><a href="#"><img src="./assets/images/icons/users.svg" />Mes paramètres</a></li>
                <li><a href="#"><img src="./assets/images/icons/users.svg" />Mes trajets</a></li>
                <li><a href="#"><img src="./assets/images/icons/users.svg" />Mes réservations</a></li>
                <li><a href="#"><img src="./assets/images/icons/users.svg" />Messages</a></li>
            </ul>
        </div>
    </div>

    <?php
    include __DIR__ . '/../views/' . $template . '.php';
    require __DIR__ . '/../components/footer.php';
    ?>

    <script src="./assets/js/script.js"></script>
</body>

</html>