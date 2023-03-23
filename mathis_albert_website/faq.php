<?php
session_start();

require "database.php";

if (isset($_SESSION["user_id"])) {
    $records = $conn->prepare(
        "SELECT id, email, username, password FROM users WHERE id = :id"
    );
    $records->bindParam(":id", $_SESSION["user_id"]);
    $records->execute();
    $user = $records->fetch(PDO::FETCH_ASSOC);
} else {
    $user = null;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>FAQ</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php require "partials/header.php"; ?>
<main class="container">
  <div class="container">    
    <div class="row content">
      <div class="col-sm-8 text-left"> 
        <h1>FAQ</h1>
        <p>¿Tienes preguntas sobre nuestro sitio web? Aquí están las respuestas a algunas preguntas frecuentes.</p>
        <h3>¿Cómo puedo registrarme?</h3>
        <p>Para registrarte, simplemente haz clic en el botón "Registrarse" en la esquina superior derecha de la pantalla. Ingresa tus datos y ¡listo!</p>
        <h3>¿Cómo puedo iniciar sesión?</h3>
        <p>Para iniciar sesión, haz clic en el botón "Iniciar sesión" en la esquina superior derecha de la pantalla. Ingresa tu correo electrónico y contraseña y haz clic en "Iniciar sesión".</p>
        <h3>¿Cómo puedo restablecer mi contraseña?</h3>
        <p>Si olvidaste tu contraseña, haz click <a href="https://giphy.com/gifs/theoffice-the-office-tv-moroccan-christmas-cXblnKXr2BQOaYnTni">aquí</a>.</p>
        <h3>¿Cómo puedo encontrar mi juego favorito?</h3>
        <p>Puedes buscar tu juego favorito en la barra de búsqueda en la parte superior de la página. También puedes explorar nuestras categorías de juegos para encontrar algo nuevo que te guste.</p>
        <h3>¿Cómo puedo guardar mis puntuaciones?</h3>
        <p>Para guardar tus puntuaciones y competir con otros jugadores de todo el mundo, necesitas registrarte en nuestro sitio web. Una vez registrado e iniciado sesión, tus puntuaciones se guardarán automáticamente en tu perfil.</p>
        <h3>¿Cómo puedo ponerme en contacto con el equipo de soporte?</h3>
        <p>Puedes enviarnos un correo electrónico a albmathis@gmail.com o utilizar nuestro formulario de contacto en la sección "Contacto" de nuestro sitio web.</p>
        <hr>
      </div>
    </div>
  </div>
</main>
<?php require "partials/footer.php"; ?>
</body>
</html>