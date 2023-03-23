<header>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>                        
        </button>

      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
      <li class="active"><a href="/mathis_albert_website">Home</a></li>
      <li><a href="about.php">Sobre Nosotros</a></li>
      <li><a href="projects.php">Proyectos</a></li>
      <li><a href="contact.php">Contacto</a></li>
      <li><a href="galeria.php">Galeria</a></li>
      <li><a href="faq.php">FAQ</a></li>
      <li><a href="contactformview.php">Consultas</a></li>
      <li><a href="webtree.php">Mapa Web</a></li>
    </ul>
        <ul class="nav navbar-nav navbar-right">
          <?php if(empty($user)): ?>
            <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          <?php else: ?>
            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
</header>