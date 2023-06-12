<header>
    <h1>Contactez-nous</h1>
    <?= isset($_SESSION['contactLog']['confirmation']) ? '<p>' . $_SESSION['contactLog']['confirmation'] . '</p>' : '' ?>
    <?= isset($_SESSION['contactLog']['envoi']) ? '<p>' . $_SESSION['contactLog']['envoi'] . '</p>' : '' ?>
    <?= isset($_SESSION['contactLog']['message']) ? '<p>' . $_SESSION['contactLog']['message'] . '</p>' : '' ?>
    <?= isset($_SESSION['contactLog']['email']) ? '<p>' . $_SESSION['contactLog']['email'] . '</p>' : '' ?>
    <?= isset($_SESSION['contactLog']['name']) ? '<p>' . $_SESSION['contactLog']['name'] . '</p>' : '' ?>
</header>
<section class="overlap container">
    <form class="form" method="post" action="envoi_mail.php">
        <div>
            <label for="name">Nom</label>
            <input type="text" id="name" name="name" placeholder="John Doe" <?= isset($_SESSION['user']['name']) ? 'value="' . $_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['name'] . '" readonly' : '' ?> required>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="john.doe@gmail.com" <?= isset($_SESSION['user']['name']) ? 'value="' . $_SESSION['user']['email'] . '" readonly' : '' ?> required>
        </div>
        <div>
            <label for="message">Message</label>
            <textarea id="message" name="message" placeholder="Votre message..." required></textarea>
        </div>
        <button class="btn green" type="submit">Envoyer</button>
    </form>
</section>
<?php
    unset($_SESSION['contactLog']);
?>