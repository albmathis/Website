<?php

// Inicio de sesión
session_start();

// Verificación de si el usuario ya inició sesión
if (isset($_SESSION["user_id"])) {
    header("Location: /mathis_albert_website");
    exit();
}

// Requerir archivo con la conexión a la base de datos
require "database.php";

// Declaración de variable para mensajes de error
$message = "";

// Verificación de si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
        $message = "Porfavor ingresa un email";
    } elseif (empty($_POST["password"])) {
        $message = "Porfavor ingresa una contraseña";
    } else {
        // Obtener valores del formulario
        $email = htmlspecialchars($_POST["email"], ENT_QUOTES);
        $password = htmlspecialchars($_POST["password"], ENT_QUOTES);

        // Preparar y ejecutar consulta para obtener registros del usuario
        $records = $conn->prepare(
            "SELECT id, email, password FROM users WHERE email = :email"
        );
        $records->bindParam(":email", $email);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        // Verificar si se encontró un registro y si la contraseña coincide con el hash en la base de datos
        if ($results && password_verify($password, $results["password"])) {
            // Iniciar sesión y redirigir al usuario a la página de inicio de sesión
            $_SESSION["user_id"] = $results["id"];
            header("Location: /mathis_albert_website");
            exit();
        } else {
            // Mensaje de error en caso de credenciales incorrectas
            $message = "Correo electrónico o contraseña inválidos.";
        }
    }
}


?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="js/sanitize.js"></script>
</head>
<body>
  <?php require 'partials/header.php' ?>
  <main class="container">
  <?php if(!empty($message)): ?>
    <p> <?= htmlspecialchars($message, ENT_QUOTES) ?></p>
  <?php endif; ?>

  <h1>Login</h1>
  <span>or <a href="signup.php">SignUp</a></span>
    <form id="loginForm" action="login.php" method="POST" onsubmit="return sanitizeForm();">
      <input name="email" type="text" placeholder="Email">
      <input name="password" type="password" placeholder="Contraseña">
      <input type="submit" value="Submit">
    </form>
  </main>
  <?php require 'partials/footer.php' ?>
</body>
</html>