<?php
session_start();

require 'database.php';

// Redirige al login si el usuario no esta logeado
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  die();
}

// Comprueba si el formulario fue enviado y el ID del proyecto también.
if (isset($_POST['id'])) {
  $id = $_POST['id'];

  // Borra el proyecto de la base de datos.
  $stmt = $conn->prepare('DELETE FROM projects WHERE id = :id');
  $stmt->bindParam(':id', $id);
  $stmt->execute();

  // Redirige a la pagina de proyectos
  header("Location: projects.php");
  die();
}