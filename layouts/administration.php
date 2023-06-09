<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VrooMMI Admin <?= isset($pageTitle) ? ' - ' . $pageTitle : '' ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <?php
    require __DIR__ . '/../inc/lib.inc.php';

    require __DIR__ . '/../components/admin/navbar.php';
    include __DIR__ . '/../views/admin/' . $template . '.php';
    ?>
</body>

</html>