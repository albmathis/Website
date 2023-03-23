function validateForm() {
  // Recoge las variables de el formulario
    var username = document.forms["signupForm"]["username"].value;
    var email = document.forms["signupForm"]["email"].value;
    var password = document.forms["signupForm"]["password"].value;
    var confirm_password = document.forms["signupForm"]["confirm_password"].value;
  
    // Comprueba que todos los campos estan rellenados
    if (username == "" || email == "" || password == "" || confirm_password == "") {
      alert("Todos los campos deben ser rellenados");
      return false;
    }
  
    // Validacion del email usando regex
    var email_regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email_regex.test(email)) {
      alert("Porfavor, Valida el Email");
      return false;
    }
    // Comprueba que la contraseña sea mayor a 8 caracteres
    if (password.length < 8) {
      alert("La contraseña debe tener al menos 8 caracteres de longitud");
      return false;
    }
    // Comprueba que las dos contraseñas sean iguales.
    if (password != confirm_password) {
      alert("Las contraseñas no coinciden");
      return false;
    }
  }