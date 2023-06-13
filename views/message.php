<?php
$db = dbConnect();
if (!isset($_SESSION['user'])) {
    header('Location: connexion.php');
}

if(isset($_GET['id']) AND !empty($_GET['id'])){
    $getid = $_GET['id'];
    $sessionid = $_SESSION['user']['id'];
    $recupUser = $db->prepare('SELECT * FROM users WHERE id = ?');
    $recupUser->execute(array($getid));
    if($recupUser->rowCount() > 0){
        if(isset($_POST['envoyer'])){
            $message = htmlspecialchars($_POST['message']);
            $insererMessage = $db->prepare('INSERT INTO messages(content, author_id, target_id) VALUES (?, ?, ?)');
            $insererMessage->execute(array($message, $sessionid, $getid));
        }
    }else{
        echo 'Aucun utilisateur trouvé';
    }
}else{
    echo 'Aucun identifiant trouvé';
}

?>

<form method="POST" action="">

    <textarea name="message"></textarea>
    <br><br>
    <input type="submit" name="envoyer">
</form>

<section id="messages">

    <?php
    $recupMessages = $db->prepare('SELECT * FROM messages WHERE author_id = ? AND target_id = ? OR author_id = ? AND target_id = ? ORDER BY id DESC');
    $recupMessages->execute(array($sessionid, $getid, $getid, $sessionid));
    while($message = $recupMessages->fetch()){
        if($message['author_id'] == $sessionid){
            ?>
            <p style="color:green;"><?= $message['content']; ?></p>
            <?php
    }elseif($message['author_id'] == $getid){
        ?>
        <p style="color:red;"><?= $message['content']; ?></p>
        <?php
    }
}
?>

</section>