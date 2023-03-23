<?php
session_start();

require 'database.php';

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    $user = $_SESSION['user_id'];
} else {
    header("Location: login.php");
    die();
}

// Selecciona el proyecto que hemos seleccionado anteriormente en projects.php segun el id que le pasamos.
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare('SELECT * FROM projects WHERE id = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $project = $stmt->fetch(PDO::FETCH_ASSOC);
}

function getYoutubeVideoId($url) {
    $parts = parse_url($url);
    if (isset($parts['query'])) {
        parse_str($parts['query'], $query);
        if (isset($query['v'])) {
            return $query['v'];
        }
    }
    $path = trim($parts['path'], '/');
    if (strpos($path, 'v/') === 0) {
        return substr($path, 2);
    }
    return $path;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= $project['name'] ?></title>
    <!-- Include Bootstrap CSS and JS files -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://www.youtube.com/iframe_api"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <script>
        var player;
        function onYouTubeIframeAPIReady() {
            player = new YT.Player('player', {
                height: '390',
                width: '640',
                videoId: '<?= getYoutubeVideoId($project['video_url']) ?>',
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });
        }
        function onPlayerReady(event) {
            event.target.playVideo();
        }
        function onPlayerStateChange(event) {
            if (event.data == YT.PlayerState.PLAYING && !done) {
                setTimeout(stopVideo, 6000);
                done = true;
            }
        }
        function stopVideo() {
            player.stopVideo();
        }
    </script>
</head>
<body>
<?php require 'partials/header.php' ?>
<!-- Sección HTML para mostrar los detalles de un proyecto -->
<main class="container custom-flex">
  <div class="container">
    <h1>
      <?= $project['name'] ?>
    </h1> 
    <!-- Muestra el nombre del proyecto -->
    <p>
      <?= $project['description'] ?>
    </p> 
    <!-- Muestra la descripción del proyecto -->
    <div id="player">
    </div> 
    <!-- Muestra el video del juego -->
    <p>
      <strong>Download Game URL:
      </strong> 
      <a href="<?= $project['download_url'] ?>" target="_blank">
        <?= $project['download_url'] ?>
      </a>
    </p> 
    <!-- Muestra el enlace de descarga del juego -->
    <?php if ($project['image']): ?> 
    <!-- Si el proyecto tiene imagen, muestra la imagen -->
    <img src="data:image/jpeg;base64,<?= base64_encode($project['image']) ?>" alt="<?= $project['name'] ?>">
    <?php endif; ?>
    <hr>
    <form method="POST" action="delete_project.php"> 
      <!-- Formulario para eliminar el proyecto -->
      <input type="hidden" name="id" value="<?= $project['id'] ?>"> 
      <!-- Input oculto con el id del proyecto a eliminar -->
      <button type="submit" class="btn btn-danger">Eliminar Proyecto
      </button> 
      <!-- Botón para enviar el formulario y eliminar el proyecto -->
    </form>
  </div>
</main>
<?php require 'partials/footer.php' ?>
</body>
</html>