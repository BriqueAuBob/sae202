<?php require 'head.php'; ?>
<p>Bonjour,</p>
<h1><?= $_SESSION['firstname'] ?></h1>
<?php echo '<a href="profil.php"><img src="images/'. $_SESSION['profile_pic'] .'"></a>';?>