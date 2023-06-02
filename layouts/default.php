<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    require 'inc/lib.inc.php';

    require __DIR__ . '/../components/navbar.php';
    include __DIR__ . '/../templates/' . $template . '.php';
    ?>
</body>

</html>