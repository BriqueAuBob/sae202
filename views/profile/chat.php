<?php
$db = dbConnect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_GET['id']) and !empty($_GET['id'])) {
        $getid = $_GET['id'];
        $sessionid = $_SESSION['user']['id'];
        $recupUser = $db->prepare('SELECT * FROM users WHERE id = ?');
        $recupUser->execute(array($getid));
        if ($recupUser->rowCount() > 0) {
            $message = $_POST['message'];
            $insererMessage = $db->prepare('INSERT INTO messages(content, author_id, target_id) VALUES (?, ?, ?)');
            $insererMessage->execute(array($message, $sessionid, $getid));
            header('Location: /profil/messages.php?id=' . $getid);
        } else {
            header('Location: /profil/messages.php');
        }
    } else {
        header('Location: /profil/messages.php');
    }
    die();
}

$recupUser = $db->prepare('
    SELECT 
        *, 
        messages.created_at as creation_date,
        users.id as user_id,
        target.first_name as target_first_name,
        target.last_name as target_last_name,
        target.picture as target_picture
    FROM messages 
    INNER JOIN users as target ON messages.target_id = target.id
    INNER JOIN users ON messages.author_id = users.id
    WHERE author_id = ? OR target_id = ?
    ORDER BY creation_date DESC
');
$recupUser->execute([
    $_SESSION['user']['id'],
    $_SESSION['user']['id'],
]);

$conversations = $recupUser->fetchAll();
if (!isset($_GET['id'])) {
    if (isset($conversations[0])) {
        header('Location: /profil/messages.php?id=' . ($conversations[0]['user_id'] === $_SESSION['user']['id'] ? $conversations[0]['target_id'] : $conversations[0]['user_id']));
        die();
    }
} else {
    $conversationId = $_GET['id'];
    $conversationUser = $db->prepare('
        SELECT 
            *, 
            messages.created_at as creation_date,
            target.id as target_id,
            target.first_name as target_first_name,
            target.last_name as target_last_name,
            target.picture as target_picture,
            author.id as author_id,
            author.first_name as author_first_name,
            author.last_name as author_last_name,
            author.picture as author_picture
        FROM messages 
        INNER JOIN users as target ON messages.target_id = target.id
        INNER JOIN users as author ON messages.author_id = author.id
        WHERE (author_id = ? AND target_id = ?) OR (author_id = ? AND target_id = ?)
        ORDER BY creation_date DESC
    ');
    $conversationUser->execute([
        $conversationId,
        $_SESSION['user']['id'],
        $_SESSION['user']['id'],
        $conversationId,
    ]);
    $conversationUser = $conversationUser->fetch(PDO::FETCH_ASSOC);
    if (!$conversationUser) {
        header('Location: /profil/messages.php');
    }
    if ($conversationUser['target_id'] == $_SESSION['user']['id']) {
        $conversationUser = [
            'id' => $conversationUser['author_id'],
            'first_name' => $conversationUser['author_first_name'],
            'last_name' => $conversationUser['author_last_name'],
            'picture' => $conversationUser['author_picture'],
        ];
    } else {
        $conversationUser = [
            'id' => $conversationUser['target_id'],
            'first_name' => $conversationUser['target_first_name'],
            'last_name' => $conversationUser['target_last_name'],
            'picture' => $conversationUser['target_picture'],
        ];
    }
}
?>
<section class="grid cols-3 align-top container">
    <div class="card big <?= !isset($conversationUser) ? 'col-3' : '' ?>">
        <h1>Vos conversations</h1>
        <ul class="conversations">
            <?php
            if ($recupUser->rowCount() == 0) {
                echo '<li>Vous n\'avez aucune conversation pour le moment. Réservez un trajet pour ouvrir une discussion.</li>';
            } else {
                $display = [];
                foreach ($conversations as $conversation) {
                    if (isset($display[$conversation['author_id'] . '-' . $conversation['target_id']]) or isset($display[$conversation['target_id'] . '-' . $conversation['author_id']])) {
                        continue;
                    }
                    $display[$conversation['author_id'] . '-' . $conversation['target_id']] = true;
                    if ($conversation['user_id'] !== $_SESSION['user']['id']) {
                        echo '<li><a ' . ($conversation['user_id'] == $conversationId ? 'class="active"' : '') . ' href="/profil/messages.php?id=' . $conversation['user_id'] . '"><img class="avatar" src="/assets/images/avatars/' . $conversation['picture'] . '" />' . $conversation['first_name'] . ' ' . $conversation['last_name'] . '</a></li>';
                    } else {
                        echo '<li><a ' . ($conversation['user_id'] == $conversationId ? 'class="active"' : '') . ' href="/profil/messages.php?id=' . $conversation['user_id'] . '"><img class="avatar" src="/assets/images/avatars/' . $conversation['target_picture'] . '" />' . $conversation['target_first_name'] . ' ' . $conversation['target_last_name'] . '</a></li>';
                    }
                }
            }
            ?>
        </ul>
    </div>
    <?php
    if (isset($conversationUser)) {
    ?>
        <div class="col-2 chatbox">
            <h1><?= $conversationUser['first_name'] . ' ' . $conversationUser['last_name'] ?></h1>
            <div class="messages">
                <?php
                $recupMessages = $db->prepare('
                SELECT 
                    *, 
                    messages.created_at as creation_date,
                    users.id as user_id
                FROM messages
                INNER JOIN users ON messages.author_id = users.id 
                WHERE author_id = ? AND target_id = ? OR author_id = ? AND target_id = ?
                ORDER BY creation_date DESC
            ');
                $recupMessages->execute([
                    $_SESSION['user']['id'],
                    $conversationId,
                    $conversationId,
                    $_SESSION['user']['id']
                ]);
                $messages = $recupMessages->fetchAll();
                foreach ($messages as $message) {
                    echo '<div class="chat_message ' . ($message['author_id'] === $_SESSION['user']['id'] ? 'sent' : 'received') . '"><p>' . htmlspecialchars($message['content']) . '</p></div>';
                }
                ?>
            </div>
            <form action="/profil/messages.php?id=<?= $conversationId ?>" method="post" class="flex">
                <input type="text" name="message" id="message" placeholder="Votre message">
                <button class="btn green" type="submit">Envoyer</button>
            </form>
        </div>
    <?php
    }
    ?>
</section>