<?php
session_start(); // Iniciar la sesión de usuario

require 'database.php'; // Incluir el archivo que contiene la configuración de la base de datos

// Redirigir a la página de inicio de sesión si el usuario no ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  die(); // Terminar la ejecución del script
}

if (isset($_SESSION['user_id'])) {
  // Obtener la información del usuario actual desde la base de datos
  $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
  $records->bindParam(':id', $_SESSION['user_id']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);

  $user = null;

  if (count($results) > 0) {
    $user = $results;
  }

  // Obtener la lista de proyectos desde la base de datos
  $projectsQuery = $conn->query('SELECT * FROM projects');
  $projects = $projectsQuery->fetchAll(PDO::FETCH_ASSOC);

  // Manejar la presentación del formulario de nuevo proyecto
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $video_url = $_POST['video_url'];
    $download_url = $_POST['download_url'];

    // Manejar la carga de archivos
    $image = null;
    
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = file_get_contents($_FILES['image']['tmp_name']);
    }

    // Insertar el nuevo proyecto en la base de datos
    $stmt = $conn->prepare('INSERT INTO projects (name, description, video_url, download_url, image) VALUES (:name, :description, :video_url, :download_url, :image)');
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':video_url', $video_url);
    $stmt->bindParam(':download_url', $download_url);
    $stmt->bindParam(':image', $image, PDO::PARAM_LOB);
    $stmt->execute();

    // Redirigir a la misma página para evitar la reenviación del formulario al refrescar la página
    header("Location: projects.php");
    die();
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Proyectos</title>
  <!-- Include Bootstrap CSS and JS files -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
</head>
<body>
    <?php require 'partials/header.php' ?>
  <div class="container">
    <h1>Proyectos</h1>
    <ul>
        <?php foreach ($projects as $project): ?>
          <!-- Este código genera un enlace para cada proyecto en la lista de proyectos. Al hacer clic en el enlace, el usuario es llevado a la página de detalles del proyecto correspondiente. -->
          <li><a href="project_details.php?id=<?= $project['id'] ?>"><?= $project['name'] ?></a></li>
        <?php endforeach; ?>
    </ul>
	<h2>Nuevo Proyecto:</h2>
	<form method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label for="name">Nombre:</label>
			<input type="text" class="form-control" id="name" name="name" required>
		</div>
		<div class="form-group">
			<label for="description">Descripcion:</label>
			<textarea class="form-control" id="description" name="description" required></textarea>
		</div>
		<div class="form-group">
			<label for="video_url">URL Video:</label>
			<input type="url" class="form-control" id="video_url" name="video_url" required>
		</div>
		<div class="form-group">
			<label for="download_url">URL Juego:</label>
			<input type="url" class="form-control" id="download_url" name="download_url" required>
		</div>
		<div class="form-group">
			<label for="image">Imagen/GIF:</label>
			<input type="file" class="form-control" id="image" name="image">
		</div>
		<button type="submit" class="btn btn-primary">Add Project</button>
	</form>
  </div>
</body>
<?php require 'partials/footer.php' ?>
</html>