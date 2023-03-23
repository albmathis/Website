<?php

session_start();

require 'database.php';

// Comprueba si el usuario ha iniciado sesión
if (isset($_SESSION['user_id'])) {
    $user = $_SESSION['user_id'];
} else {
    $user = null;
}
$message = "";

if (!empty($_POST["email"]) && !empty($_POST["message"]) && !empty($_POST["name"])) {
    // Limpiar la entrada
    $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $message = filter_var($_POST["message"], FILTER_SANITIZE_STRING);

    // Validar dirección de correo electrónico
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Formato de correo electrónico inválido";
    } else {
        // Insertar informacion de contacto en la base de datos
        $sql =
            "INSERT INTO contact_form (name, email, message) VALUES (:name, :email, :message)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":message", $message);

        if ($stmt->execute()) {
            $message = "Mensaje enviado con exito";
        } else {
            $message = "Lo sentimos, hubo un problema";
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Contactanos</title>
	<!-- Include Bootstrap CSS and JS files -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="validatecontact.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <?php require 'partials/header.php' ?>
	<div class="container">
    <h1>Contacto</h1>
      <p>No dudes en contactarnos con cualquier pregunta o comentario:</p>
      <ul>
        <li>Email: albmathis@gmail.com</li>
        <li>Teléfono: 971 761 808 - 971 208 653</li>
        <li>Dirección: C/ Jesús, 15 07003 Palma de Mallorca Illes Balears</li>
      </ul>
    </div>
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <p>No dudes en contactarnos con cualquier pregunta o comentario:</p>
        <form method="POST" action="contact.php">
      <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="form-group">
            <label for="email">Correo electrónico:</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="form-group">
            <label for="message">Mensaje:</label>
            <textarea class="form-control" id="message" name="message" required></textarea>
          </div>
          <hr>
          <?php if(!empty($message)): ?>
           <p> <?= $message ?></p>
          <?php endif; ?>
          <hr>
          <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
        </form>
      </div>
      <div class="col-md-6">
      <h3>Nuestro Business Center</h3>
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3073.1354764331173!2d2.643597214905178!3d39.56994097947356!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1297942f8b8e773d%3A0x7c99b16ccbf1a3eb!2sCarrer%20de%20Jesus%2C%2015%2C%2007003%20Palma%2C%20Illes%20Balears%2C%20Spain!5e0!3m2!1sen!2sus!4v1647011987259!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
  </div>
</div>
	<?php require 'partials/footer.php' ?>
</body>
</html>