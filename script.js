document.addEventListener('DOMContentLoaded', function() {
  var form = document.querySelector('form');
  form.onsubmit = function(event) {
    // Validation de formulaire simple
    var nom = document.getElementById('nom').value;
    if(nom.length < 2) {
      alert('Veuillez entrer un nom valide.');
      event.preventDefault();
    }
    // Ajoutez d'autres validations si nécessaire
  };
});
