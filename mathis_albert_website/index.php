<?php
session_start(); // Inicia la sesión

require "database.php"; // Se requiere la conexión a la base de datos

if (isset($_SESSION["user_id"])) {
    // Si hay un usuario conectado
    // Selecciona los datos del usuario de la base de datos
    $records = $conn->prepare(
        "SELECT id, email, username, password FROM users WHERE id = :id"
    );
    $records->bindParam(":id", $_SESSION["user_id"]);
    $records->execute();
    $user = $records->fetch(PDO::FETCH_ASSOC); // Guarda los datos del usuario en un arreglo asociativo
} else {
    $user = null; // Si no hay un usuario conectado, el arreglo asociativo está vacío
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Albert Mathis</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="assets/css/style.css"> <!-- Agrega el archivo de estilos CSS -->
</head>
<body>
<?php require "partials/header.php"; ?> <!-- Requiere el archivo del encabezado -->
<main class="container">
  <div class="container">    
    <div class="row content">
      <div class="col-sm-8 text-left"> 
        <br>
        <?php echo !empty($user)
            ? "<h1>Hola {$user["username"]}!</h1>"
            : "<h1>Hola!</h1>"; ?> <!-- Muestra el nombre del usuario si está conectado -->
            
        <p>Aquí encontrarás una gran variedad de juegos divertidos para todas las edades. Desde juegos clásicos hasta los más novedosos, tenemos todo lo que necesitas para pasar un buen rato.</p>
        <p>¿Te gustan los juegos de acción? Tenemos una amplia selección de juegos de disparos y pelea que te mantendrán entretenido durante horas.</p>
        <p>¿Prefieres los juegos de estrategia? Prueba nuestros juegos de ajedrez y estrategia militar, o pon a prueba tus habilidades en juegos de lógica y puzzles.</p>
        <p>También contamos con una sección especial para los más pequeños de la casa, con juegos educativos y divertidos que les ayudarán a desarrollar sus habilidades mientras se divierten.</p>
        <p>¡Explora nuestra página y encuentra tu juego favorito! Además, no olvides registrarte para guardar tus puntuaciones y competir con otros jugadores de todo el mundo. ¡Que comience la diversión!</p>
        <hr>
        <h2>Los mejores juegos para todas las edades</h2>
          <p>¿Estás buscando un juego nuevo y emocionante para jugar? En nuestro sitio web, ofrecemos una amplia selección de juegos para todas las edades. Ya sea que te gusten los juegos de acción, aventuras, estrategia, deportes o rompecabezas, ¡tenemos algo para ti!</p>
          <h3>Únete a nuestra comunidad de jugadores</h3>
          <p>En nuestro sitio web, no solo puedes jugar tus juegos favoritos, sino también conectarte con otros jugadores de todo el mundo. Únete a nuestra comunidad de jugadores, comparte tus puntajes, descubre nuevos juegos y haz nuevos amigos.</p>
          <h4>Explora nuestros juegos populares</h4>
          <ul>
            <li>Juego de disparos en primera persona</li>
            <li>Juego de carreras de autos</li>
            <li>Juego de estrategia militar</li>
            <li>Juego de puzzles y rompecabezas</li>
            <li>Juego de aventuras emocionante</li>
          </ul>
          <h5>Conviértete en el campeón de nuestros juegos</h5>
          <p>¿Tienes lo que se necesita para ser el campeón de nuestros juegos? Regístrate en nuestro sitio web, guarda tus puntajes y compite con otros jugadores para llegar a la cima de nuestra tabla de clasificación. ¡Que comience la competencia!</p>
          <h6><i>Diviértete en nuestro sitio web</i></h6>
          <p>En nuestro sitio web, la <b>diversión</b> nunca se detiene. Explora nuestra selección de juegos, descubre nuevos desafíos y disfruta de horas de entretenimiento. ¡Gracias por visitarnos y diviértete jugando en nuestro sitio web de juegos!</p>
      </div>
    </div>
  </div>
</main>
<?php require "partials/footer.php"; ?> <!-- Requiere el archivo del pie de página -->
</body>
</html>