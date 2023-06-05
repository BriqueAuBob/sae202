<p>Bonjour,</p>
<h1><?= $_SESSION['firstname'] ?></h1>
<?php echo '<a href="profil.php"><img src="assets/images/avatars/' . $_SESSION['picture'] . '"></a>'; ?>

<a href="deconnexion.php" class="btn">Déconnexion</a>