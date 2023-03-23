<?php

require "database.php";

$message = "";

if (!empty($_POST["email"]) && !empty($_POST["password"])) {
    // Limpiar la entrada
    $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);

    // Validar dirección de correo electrónico
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Formato de correo electrónico inválido";
    } else {
        // Comprueba si el usuario ya existe en la base de datos
        $sql_check = "SELECT COUNT(*) AS count FROM users WHERE email = :email";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bindParam(":email", $email);
        $stmt_check->execute();
        $result_check = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if ($result_check["count"] > 0) {
            $message =
                "Este correo electrónico ya está en uso. Por favor, utiliza otro.";
        } else {
            // Insertar usuario en la base de datos
            $sql =
                "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":email", $email);
            $password = password_hash($password, PASSWORD_BCRYPT);
            $stmt->bindParam(":password", $password);

            if ($stmt->execute()) {
                $message = "Nuevo usuario creado con éxito";
            } else {
                $message = "Lo sentimos, hubo un problema al crear tu cuenta";
            }
        }
    }
}

?>
<!DOCTYPE html>
<html>
  <head>
  <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="js/validateform.js"></script>
  </head>
  <body>

    <?php require 'partials/header.php' ?>
    <main class="container">
    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>SignUp</h1>
    <span>or <a href="login.php">Login</a></span>

    <form name="signupForm" action="signup.php" method="POST" onsubmit="return validateForm();">
      <input name="username" type="text" placeholder="Usuario" required>
      <input name="email" type="text" placeholder="Email" required>
      <input name="password" type="password" placeholder="Contraseña" required>
      <input name="confirm_password" type="password" placeholder="Confirmar Contraseña" required>
      <input type="submit" value="Submit">
    </form>
    </main>
  </body>
  <?php require 'partials/footer.php' ?>
</html>
