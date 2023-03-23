<?php
session_start();

require "database.php";

if (isset($_SESSION["user_id"])) {
    $records = $conn->prepare(
        "SELECT id, email, password FROM users WHERE id = :id"
    );
    $records->bindParam(":id", $_SESSION["user_id"]);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
        $user = $results;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sobre nosotros</title>
	<!-- Incluye archivos CSS y JS de Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <?php require "partials/header.php"; ?>
	<div class="container">
		<h1>Sobre nosotros</h1>
			<p>Somos una empresa de juegos en línea comprometida a proporcionar a nuestros usuarios la mejor experiencia de juego posible. Nos enorgullece ofrecer una amplia variedad de juegos divertidos y emocionantes para todas las edades y niveles de habilidad.</p>
			<p>En nuestro sitio web, encontrarás una selección cuidadosamente curada de juegos, que van desde los clásicos hasta los más novedosos. Desde juegos de acción hasta juegos de estrategia, juegos de carreras, juegos de deportes y mucho más, tenemos algo para cada tipo de jugador.</p>
			<p>Además de ofrecer una amplia variedad de juegos, también nos esforzamos por brindar un servicio al cliente excepcional. Siempre estamos disponibles para responder a cualquier pregunta o inquietud que puedas tener sobre nuestros juegos o tu cuenta de usuario.</p>
			<p>Y si eres un jugador comprometido que busca subir de nivel, asegúrate de registrarte para obtener una cuenta de usuario en nuestro sitio web. Con una cuenta, podrás guardar tus puntuaciones, competir con otros jugadores de todo el mundo y acceder a contenido exclusivo solo para miembros.</p>
			<p>En resumen, estamos dedicados a proporcionar a nuestros usuarios una experiencia de juego inolvidable. ¡Explora nuestra página y descubre tus nuevos juegos favoritos hoy mismo!</p>
		<h1>Nuestra historia</h1>
			<p>Comenzamos como una pequeña empresa de juegos en línea hace más de 10 años. Desde entonces, hemos trabajado arduamente para ofrecer la mejor selección de juegos y el mejor servicio al cliente posible.</p>
			<p>A lo largo de los años, hemos crecido y nos hemos expandido para incluir una variedad de juegos emocionantes y divertidos para jugadores de todas las edades y habilidades.</p>
			<p>En nuestro sitio web, siempre encontrarás los juegos más populares y emocionantes, junto con algunos juegos únicos y exclusivos que no encontrarás en ningún otro lugar.</p>
			<p>Nuestro equipo de expertos en juegos trabaja duro para asegurarse de que siempre tengas acceso a los últimos juegos y las mejores experiencias de juego. Además, siempre estamos disponibles para responder a cualquier pregunta o inquietud que puedas tener sobre nuestros juegos o nuestro sitio web.</p>
			<p>En resumen, nuestra pasión por los juegos en línea nos ha llevado a ser una de las mejores empresas de juegos en línea. ¡Gracias por elegirnos y esperamos que disfrutes de nuestros juegos!</p>
		<div class="row">
			<div class="col-md-4">
				<a href="https://www.ign.com/games" target="_blank"><img src="img/horse.jpg" class="img-responsive"></a>
			</div>
			<div class="col-md-4">
				<a href="https://kotaku.com/tag/video-games" target="_blank"><img src="img/person.jpg" class="img-responsive"></a>
			</div>
			<div class="col-md-4">
				<a href="http://www.shadowstats.com/" target="_blank"><img src="img/elden.jpg" class="img-responsive"></a>
			</div>
		</div>
	</div>
	<?php require "partials/footer.php"; ?>
</body>
</html>