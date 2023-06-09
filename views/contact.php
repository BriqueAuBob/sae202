<header>
    <h1>Contactez-nous</h1>
</header>
<section class="overlap container">
    <form class="form" method="post" action="envoi_mail.php">
        <div>
            <label for="name">Nom</label>
            <input type="text" id="name" name="name" placeholder="John Doe" <?= isset($_SESSION['user']['name']) ? 'value="' . $_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['name'] . '" disabled' : '' ?> required>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="john.doe@gmail.com" <?= isset($_SESSION['user']['name']) ? 'value="' . $_SESSION['user']['email'] . '" disabled' : '' ?> required>
        </div>
        <div>
            <label for="message">Message</label>
            <textarea id="message" name="message" placeholder="Votre message..." required></textarea>
        </div>
        <button class="btn green" type="submit">Envoyer</button>
    </form>
</section>