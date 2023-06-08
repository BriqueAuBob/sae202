<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? $pageTitle : '' ?></title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>
    <?php
    require '../../inc/lib.inc.php';

    include __DIR__ . '/../views/admin/forms/' . $template . '.php';
    ?>
</body>

</html>