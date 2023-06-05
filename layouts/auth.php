<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VrooMMI <?= isset($pageTitle) ? ' - ' . $pageTitle : '' ?></title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <?php
    require 'inc/lib.inc.php';

    require __DIR__ . '/../components/navbar.php';

    echo <<<HTML
        <main class="grid cols-2" id="auth">
            <div>
                <h1>VrooMMI</h1>
                <p>Le covoiturage pour les étudiants de MMI</p>
            </div>
        <div>
    HTML;
    include __DIR__ . '/../views/' . $template . '.php';
    echo '</div></main>';
    ?>

    <script src="./assets/js/script.js"></script>
</body>

</html>