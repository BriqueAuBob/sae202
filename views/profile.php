<p>Bonjour,</p>
<h1><?= $_SESSION['firstname'] ?></h1>
<img src="assets/images/avatars/<?= $_SESSION['picture'] ?>" alt="Profile picture" style="display: block;">


<a href="">Modifier les informations personnelles</a>
<a href="">Modifier la photo de profile</a>

<a href="deconnexion.php" class="btn">Déconnexion</a>