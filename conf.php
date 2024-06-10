<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $date = $_POST['date'];
  $heure = $_POST['heure'];
  $email = $_POST['email'];

  // Valider et traiter les données ici
  // Par exemple, enregistrer les données dans une base de données

  // Rediriger vers une nouvelle page ou afficher un message de succès
  echo "Rendez-vous pris pour $prenom $nom le $date à $heure.";
}
?>
