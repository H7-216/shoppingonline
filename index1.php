<?php
// fichier: submit-contact.php

// Vérifiez si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collectez les données du formulaire
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Vérifiez si les champs sont remplis
    if (empty($name) || empty($email) || empty($message)) {
        echo "Tous les champs sont nécessaires.";
    } else {
        // Envoyez un email avec les informations du formulaire
        $to = 'votre_email@example.com';
        $subject = 'Nouveau message de contact';
        $headers = 'From: ' . $email;

        $body = "Nom: " . $name . "\n";
        $body .= "Email: " . $email . "\n";
        $body .= "Message:\n" . $message;

        if (mail($to, $subject, $body, $headers)) {
            echo "Merci pour votre message. Nous vous répondrons dans les plus brefs délais.";
        } else {
            echo "Il y a eu un problème lors de l'envoi de votre message.";
        }
    }
}
?>
