<?php
session_start();
require 'database.php';

// Comprueba si el usuario ha iniciado sesión
if (isset($_SESSION['user_id'])) {
    $user = $_SESSION['user_id'];
} else {
    header("Location: login.php");
    exit;
}


// Selecciona todos los elementos de la tabla contact_form
$sql = "SELECT * FROM contact_form";
$stmt = $conn->prepare($sql);
$stmt->execute();
$entries = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Consultas</title>
	<!-- Include Bootstrap CSS and JS files -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<?php require 'partials/header.php' ?>
	<div class="container">
		<h1>Consultas</h1>
		<table class="table">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Email</th>
					<th>Mensaje</th>
					<th>Fecha</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($entries as $entry): ?>
				<tr>
					<td><?php echo htmlspecialchars($entry['name']); ?></td>
					<td><?php echo htmlspecialchars($entry['email']); ?></td>
					<td><?php echo htmlspecialchars($entry['message']); ?></td>
					<td><?php echo htmlspecialchars($entry['created_at']); ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<?php require 'partials/footer.php' ?>
</body>
</html>
