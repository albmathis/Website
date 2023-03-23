<footer class="footer" >
<link rel="stylesheet" href="assets/css/stylefooter.css">
	<div class="waves">
		<div class="wave" id="wave1"></div>
		<div class="wave" id="wave2"></div>
		<div class="wave" id="wave3"></div>
		<div class="wave" id="wave4"></div>
	</div>

	<ul class="menu">
		<li class="menu__item"><a class="menu__link" href="#">Home</a></li>
		<li class="menu__item"><a class="menu__link" href="about.php">Sobre Nosotros</a></li>
		<li class="menu__item"><a class="menu__link" href="projects.php">Proyectos</a></li>
		<li class="menu__item"><a class="menu__link" href="contact.php">Contacto</a></li>
		<li class="menu__item"><a class="menu__link" href="galeria.php">Galeria</a></li>
		<li class="menu__item"><a class="menu__link" href="faq.php">FAQ</a></li>
		<li class="menu__item"><a class="menu__link" href="contactformview.php">Consultas</a></li>
		<li class="menu__item"><a class="menu__link" href="webtree.php">Mapa Web</a></li>
	</ul>
	<p style="opacity: 0.75;">Hecho con mucho 🤍</p>

</footer>
<script>
// Para que haga el Log Out después de 5 minutos inactivo
var timeoutDuration = 300000; // 5 minutes

// timer para redirigir al usuario al logout y por ende al inicio de la página.
setTimeout(function() {
  window.location.href = 'logout.php';
}, timeoutDuration);
</script>