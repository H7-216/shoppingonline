<?php
// Exemple de script PHP pour traiter les données du formulaire de réservation

// Vérifiez si le formulaire a été soumis via la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collectez les données du formulaire
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $heure = $_POST['heure'];

    // Validez et nettoyez les données
    $nom = filter_var($nom, FILTER_SANITIZE_STRING);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $date = filter_var($date, FILTER_SANITIZE_STRING);
    $heure = filter_var($heure, FILTER_SANITIZE_STRING);

    // Ici, vous ajouterez le code pour enregistrer les données dans votre base de données
    // Par exemple, en utilisant PDO pour une base de données MySQL
    try {
        $pdo = new PDO('mysql:host=8080;dbname=00000000', 'h7_06200', 'Hamza06*&');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare('INSERT INTO reservations (nom, email, date, heure) VALUES (:nom, :email, :date, :heure)');
        $stmt->execute(array(
            ':nom' => $nom,
            ':email' => $email,
            ':date' => $date,
            ':heure' => $heure
        ));
    } catch (PDOException $e) {
        // Gérez l'erreur ici
        exit('Erreur de connexion à la base de données : ' . $e->getMessage());
    }

    // Pour envoyer une notification par e-mail, utilisez la fonction mail()
    $to = 'hmoussa006@gmail.com';
    $subject = 'Nouvelle réservation';
    $message = "Vous avez reçu une nouvelle réservation de la part de $nom.\nEmail: $email\nDate: $date\nHeure: $heure";
    $headers = 'From: webmaster@example.com';

    if (mail($to, $subject, $message, $headers)) {
        // Redirection vers une page de confirmation si l'email a été envoyé
        header('Location: confirmation.html');
        exit();
    } else {
        // Gérez l'erreur d'envoi d'email ici
        exit('Erreur lors de l\'envoi de l\'email.');
    }
}
?>