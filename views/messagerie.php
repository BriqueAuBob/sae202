<?php
$db = dbConnect();
if (!isset($_SESSION['user'])) {
    header('Location: connexion.php');
}
?>

<?php

    $recupUser = $db->query('SELECT * FROM users');
    while ($user = $recupUser->fetch()) {
            ?>
            <a href="message.php?id=<?php echo $user['id'];?>">
            <p><?php echo $user['first_name'],' '.$user['last_name']; ?></p></a>
            <?php
        }
    ?>
