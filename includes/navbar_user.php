<?php include_once("controladores/validar_login.php");?>
<nav class="navbar navbar-expand-lg navbar-dark navbarra">
  <img class="logo" src="img/logo1.png" alt="logo_proyecto">
  <h2>Proyecto FloPaTin</h2>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-md-auto">
      <li class="nav-item active">
        <a class="nav-link" href="perfil.php"><?=$_SESSION["nombreUsuario"];?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="inicio.php">Inicio</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="juego.php">Juegos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="ayuda.php">Ayuda</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Cerrar Sesión</a>
      </li>
    </ul>
  </div>
  <img class="logo d-none d-md-block" src="img/logo.png" alt="logo_proyecto">
</nav>
