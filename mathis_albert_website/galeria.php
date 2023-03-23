<?php

session_start();

require 'database.php';

// Comprueba si el usuario ha iniciado sesión
if (isset($_SESSION['user_id'])) {
    $user = $_SESSION['user_id'];
} else {
    $user = null;
}

// Obtiene los detalles del proyecto de la base de datos
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare('SELECT * FROM projects WHERE id = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $project = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Obtiene las imágenes de los proyectos de la base de datos
$stmt = $conn->prepare('SELECT id, name, image FROM projects');
$stmt->execute();
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Galería de Proyectos</title>
    <!-- Incluye los archivos CSS y JS de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
     <!-- Style esta situado aqui, porque no funciona en el css style, probablemente por bootstrap -->
    <style>
        .project-name-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }
        .project-name-overlay:hover {
            opacity: 1;
        }
        .project-name {
            color: #fff;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>
<?php require 'partials/header.php' ?>
<main class="container custom-flex">
    <div class="container">
        <h1><i>Galería de Proyectos</i></h1>
        <!--<h3><i>Fashion</i></h3> -->
        <div>
            <?php foreach ($projects as $project): ?> <!-- Este bucle foreach recorre cada elemento de la lista de proyectos y los almacena temporalmente en la variable $project. -->
                <?php if ($project['image']): ?>  <!-- Esta declaración if verifica si el proyecto actual tiene una imagen asociada. Si es así, se muestra la imagen en la sección. -->
                    <div class="col-md-3 col-sm-3 col-xs-6"> <!-- Esta clase define el tamaño de la columna en la que se muestra la imagen. -->
                        <a href="project_details.php?id=<?= $project['id'] ?>" class="project-link"> <!-- Este enlace lleva al usuario a una página de detalles del proyecto, que utiliza la ID del proyecto en la URL. -->
                            <img src="data:image/jpeg;base64,<?= base64_encode($project['image']) ?>" alt="<?= $project['name'] ?>" class="img-responsive img-thumbnail">
                            <div class="project-name-overlay">
                                <div class="project-name"><?= $project['name'] ?></div>  <!-- Este código PHP muestra el nombre del proyecto en una capa superpuesta sobre la imagen. -->
                            </div>
                        </a>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</main>
<?php require 'partials/footer.php' ?>
</body>
</html>
