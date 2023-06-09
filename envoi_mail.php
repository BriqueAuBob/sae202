<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);


if (count($_POST) == 0) {
    header('Location: contact.php');
}

if (empty($_POST['name'])) {
    $_SESSION['contactLog']['name'] = "Veillez à bien renseigner votre nom.<br>";
    header('Location: contact.php');
    die();
}

$name = $_POST['name'];


if (empty($_POST['email'])) {
    $_SESSION['contactLog']['email'] = "Veillez à bien renseigner votre adresse mail.<br>";
    header('Location: contact.php');
    die();
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $_SESSION['contactLog']['email'] = "Veillez à bien renseigner une adresse mail valide.<br>";
    header('Location: contact.php');
    die();
}

$from = $_POST['email'];


if (empty($_POST['message'])) {
    $_SESSION['contactLog']['message'] = "Veillez à bien renseigner votre message.<br>";
    header('Location: contact.php');
    die();
}

$message = $_POST['message'];



$to = "mmi22d01@mmi-troyes.fr";
$subject = "Demande de contact de $name";
$headers = "From: $from" . "\r\n" .
    "Reply-To: $from" . "\r\n" .
    'X-Mailer: PHP/' . phpversion() . "\r\n" .
    "MIME-Version: 1.0" . "\r\n" .
    "content-type: text/html; charset=utf-8";

$contact = mail($to, $subject, $message, $headers);

if ($contact) {
    $_SESSION['contactLog']['envoi'] = "Votre message a bien été envoyé.";


    //mail confirmation
    $subject = "VROOMMI - Confirmation de contact";
    $message = "Bonjour $name,<br><br>Votre demande de contact a bien été prise en compte. Nous mettons tout en oeuvre pour vous fournir une réponse dans les plus brefs délais.
    \n Ceci est un mail automatique, merci de ne pas y répondre.";
    $headers = "From: $from" . "\r\n" .
        "Reply-To: $from" . "\r\n" .
        'X-Mailer: PHP/' . phpversion() . "\r\n" .
        "MIME-Version: 1.0" . "\r\n" .
        "content-type: text/html; charset=utf-8";

    $confirmation = mail($from, $subject, $message, $headers);

    if ($confirmation) {
        $_SESSION['contactLog']['confirmation'] = "Un mail de confirmation vous a été envoyé.";
    } else {
        $_SESSION['contactLog']['confirmation'] = "Une erreur est survenue lors de l'envoi de votre mail de confirmation.";
        header('Location: contact.php');
        die();
    }
} else {
    $_SESSION['contactLog']['envoi'] = "Une erreur est survenue lors de l'envoi de votre message.";
    header('Location: contact.php');
    die();
}

header('Location: contact.php');
die();
