<p>Bonjour,</p>
<h1><?= $_SESSION['firstname'] ?></h1>
<img src="assets/images/avatars/<?= $_SESSION['picture'] ?>" alt="Profile picture" style="display: block;">


<a href="deconnexion.php" class="btn">Déconnexion</a>

<button>Supprimer mon compte</button>

<form action="desinscription.php" method="post">
    <label for="password">Confirmez votre mot de passe</label>
    <input type="password" name="password" id="password" placeholder="Mot de passe">

    <button class="btn green" type="submit">Supprimer définitivement mon compte</button>
</form>