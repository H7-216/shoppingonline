<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
    $to = "hmoussa006@gmail.com";
    $subject = "Nouveau message de contact de " . $name;
    $body = "Nom: " . $name . "\\nEmail: " . $email . "\\nMessage: " . $message;
    $headers = "From: " . $email;
    
    if (mail($to, $subject, $body, $headers)) {
        echo "Message envoyé avec succès.";
    } else {
        echo "Erreur lors de l'envoi du message.";
    }
} else {
    echo "Méthode de requête non supportée.";
}
?>
