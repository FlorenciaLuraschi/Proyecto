<?php
include_once 'includes/head.php';
require_once("Autoload.php");
// include_once 'controladores/validar_login.php';
if(!isset($_SESSION["email"])) {
    header("location:index.php");
    exit;
}
?>
<title>Proyecto FloPaTin-Juegos</title>
</head>
<body class="body_juegos">
  <header id="tope" class="encabezado">
    <?php include_once 'includes/navbar_user.php'; ?>
    <?php include_once 'includes/carrusel.php'; ?>
  </header>
  <div class="container p-0">
    <div class="card-deck contenedor_juegos">
      <div class="card">
        <img src="img/desafio-1.jpg" class="card-img-top" alt="desafio">
        <div class="card-body">
          <a href="#">
            <button class="btn-block bottonjuego" type="submit">
              Desafio
            </button>
          </a>
          <p class="card-text">Desafia a otros para jugar.</p>
        </div>
      </div>
      <div class="card">
        <img src="img/entrenamiento-1.jpg" class="card-img-top" alt="entrenamiento">
        <div class="card-body">
          <a href="#">
            <button class="btn-block bottonjuego" type="submit">
              Entrenamiento
            </button>
          </a>
          <p class="card-text">Practica sin sumar puntos.</p>
        </div>
      </div>
    </div>
  </div>
  <?php include_once 'includes/footer.php' ?>
</body>
</html>
