$(document).ready(function() {
  $('#loginForm').submit(function(event) {
    if (!sanitizeForm()) {
      event.preventDefault();
    }
  });
});

function sanitizeForm() {
  var email = document.getElementById('email').value;
  var password = document.getElementById('password').value;
  var email_regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  // Comprueba que el regex es compatible con el formato del email
  if (!email_regex.test(email)) {
    alert("Ingresa un Email Valido");
    return false;
  }

  // Comprueba que hemos rellenado el campo del formulario
  if (password == "") {
    alert("La contraseña es necesaria");
    return false;
  }
  return true;
}