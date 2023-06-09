<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

$errors = 0;
$report = '';

if (count($_POST) == 0) {
    header('Location: /contact.php');
}

//name
if (!empty($_POST['name'])) {
    $name = $_POST['name'];
} else {
    $errors++;
    $report .= "Veillez à bien renseigner votre nom et prénom.<br>";
}

//mail
if (!empty($_POST['email'])) {
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $from = $_POST['email'];
    } else {
        $errors++;
        $report .= "Votre adresse mail est invalide.<br>";
    }
} else {
    $errors++;
    $report .= "Veillez à bien renseigner votre adresse mail.<br>";
}

//message
if (!empty($_POST['message'])) {
    $message = $_POST['message'];
} else {
    $errors++;
    $report .= "Vous ne pouvez pas envoyer un message vide.<br>";
}

//envoi
if ($errors == 0) {
    $to = "mmi22c14@mmi-troyes.fr";
    $subject = "Demande de contact de $name";
    $headers = "From: $from" . "\r\n" .
        "Reply-To: $from" . "\r\n" .
        'X-Mailer: PHP/' . phpversion() . "\r\n" .
        "MIME-Version: 1.0" . "\r\n" .
        "content-type: text/html; charset=utf-8";

    $contact = mail($to, $subject, $message, $headers);

    if ($contact) {
        echo "Votre message a bien été envoyé.";


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
            echo "Un mail de confirmation vous a été envoyé.";
        } else {
            echo "Une erreur est survenue lors de l'envoi de votre mail de confirmation.";
        }
    } else {
        echo "Une erreur est survenue lors de l'envoi de votre message.";
    }
} else {
    echo $report;
}
