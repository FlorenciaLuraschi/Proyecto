<?php
include_once 'includes/head.php';
require_once("Autoload.php");
if(!isset($_SESSION["email"])) {
    header("location:index.php");
    exit;
  }
?>
<title>Proyecto FloPaTin-Ayuda</title>
</head>
<body class=body-inicio>
  <header id="tope" class="encabezado">
    <?php include_once 'includes/navbar_user.php'; ?>
    <?php include_once 'includes/carrusel.php'; ?>
  </header>
  <div class="container-fluid">
    <div class="contenedor_ayuda">
      <h1>Preguntas Frecuentes</h1>
      <section class="section1_ayuda">
        <div class="card mb-3" style="max-width: 990px;">
          <div class="row no-gutters">
            <div class="col-md-8">
              <div class="card-body">
                <br>
                <ol>
                  <li>
                    <a href="#pregunta1"><h3>¿Qué es <strong>Proyecto FloPaTin</strong>?</h3></a>
                  </li>
                  <li>
                    <a href="#pregunta2"><h3>¿Cuál es el objetivo del Juego?</h3></a>
                  </li>
                  <li>
                    <a href="#pregunta3"><h3>¿Cómo ganar puntos?</h3></a>
                  </li>
                  <li>
                    <a href="#pregunta4"><h3>¿Cómo funciona el desafío?</h3></a>
                  </li>
                  <li>
                    <a href="#pregunta5"><h3>¿Sala de chat general? ¿Por qué?</h3></a>
                  </li>
                  <li>
                    <a href="#pregunta6"><h3>¿Qué puedo hacer en mi perfil?</h3></a>
                  </li>
                  <li>
                    <a href="#pregunta7"><h3>¿Si ganó el primer puesto obtengo un título de grado?</h3></a>
                  </li>
                  <li>
                    <a href="#pregunta8"><h3>Estar entre los primeros diez mejores ¿Me otorga superpoderes?</h3></a>
                  </li>
                </ol>
              </div>
            </div>
            <div class="col-md-4">
              <img src="img/ayuda2.jpg" class="card-img" alt="...">
            </div>
          </div>
        </div>
      </section>
      <section>
        <div class="card-columns listade_adyuda">
          <div class="card mb-3 p-2">
            <div class="card-body">
              <h2 id="pregunta1" class="card-title">¿Qué es <strong>Proyecto FloPaTin</strong>?</h2>
              <p class="card-text">Es un proyecto pensado para <em>chicos y adolescentes</em>, donde a través de un entretenido <em>juego con contenidos académicos</em> puedan aprenden y relacionarse. Nuestra <em>comunidad</em> fue diseñada para ofrecerles una <em>experiencia divertida</em> que los motive y suponga un reto, premiando a los que más saben. Allí entrarán en contacto con otros jugadores, <em>podrán desafiarse y competir por el primer puesto</em>.</p>
            </div>
          </div>
          <div class="card mb-3 p-2">
            <div class="card-body">
              <h2 id="pregunta2" class="card-title">¿Cuál es el objetivo del Juego?</h2>
              <p class="card-text">El objetivo del juego es responder cinco preguntas, de diversas categorías, en un determinado lapso de tiempo. El jugador que consiga la mayor cantidad de respuestas correctas, antes que se acabe el tiempo, será el ganador de la partida. En caso de empate, ambos jugadores se llevará la mitad de los puntos disponibles.</p>
            </div>
          </div>
          <div class="card mb-3 p-2">
            <div class="card-body">
              <h2 id="pregunta3" class="card-title">¿Cómo ganar puntos?</h2>
              <p class="card-text">Se deberá responder correctamente la mayor cantidad de preguntas de cualquier categoría al azar para obtener un total de 10 puntos. En caso de empatar, cada jugador se llevará 5 puntos. Hay dos modalidades de juego, contra la maquina (que no da puntos) o desafiar a otro jugador.</p>
            </div>
          </div>
          <div class="card mb-3 p-2">
            <div class="card-body">
              <h2 id="pregunta4" class="card-title">¿Cómo funciona el desafío?</h2>
              <p class="card-text">En la sección juego elige <strong>DESAFIAR</strong> y comienza a responder las preguntas antes que se acabe el tiempo. Una vez finalizado nuestro sistema te empareja con otro oponente (el cual también habrá respondido sus cinco preguntas) y te dará un resultado. ¿¡Quién será el vencedor del desafío!?</p>
            </div>
          </div>
          <div class="card mb-3 p-2">
            <img src="img/imagen_ayuda.jpg" class="card-img-top" alt="...">
          </div>
          <div class="card mb-3 p-2">
            <div class="card-body">
              <h2 id="pregunta5" class="card-title">¿Sala de chat general? ¿Por qué?</h2>
              <p class="card-text">Nuestra plataforma está pensada para menores de edad, por lo que tenemos especial cuidado con quienes se relacionen aqui dentro, esperando brindad seguridad y buen ambiente.</p>
              <p class="card-text">Por lo que también, te darás cuenta que no se puede escribir cualquier comentario. Fomentemos el respeto y sano juego entre todos.</p>
            </div>
          </div>
          <div class="card mb-3 p-2">
            <div class="card-body">
              <h2 id="pregunta6" class="card-title">¿Qué puedo hacer en mi perfil?</h2>
              <p class="card-text">Al ingresar en <strong>nuestra comunidad</strong> te deberás crear una cuenta, con un nombre de usuario, un avatar y diversos datos de interés. En tu perfil podrás seguir tus logros, como puntos obtenidos y publicar tus gustos para que otros te conozcan. También encontrarás una sección para publicar un pequeño estado, una pequeña frase que te identifique o te guste para el día.</p>
            </div>
          </div>
          <div class="card mb-3 p-2">
            <div class="card-body">
              <h2 id="pregunta7" class="card-title">¿Si ganó el primer puesto obtengo un título de grado?</h2>
              <p class="card-text">Emm no, todavía no estamos homologados por el Ministerio de Educación. Pero ¡Oye!, no te desanimes. ¿Quién sabe?.</p>
            </div>
          </div>
          <div class="card mb-3 p-2">
            <div class="card-body">
              <h2 id="pregunta8" class="card-title">Estar entre los primeros diez mejores ¿Me otorga superpoderes?</h2>
              <p class="card-text">Tampoco. Lo siento, sólo es un juego online de preguntas y respuestas.</p>
            </div>
          </div>
          <div class="card mb-3 p-2">
            <img src="img/ayuda6.jpg" class="card-img-top" alt="...">
          </div>
        </div>
      </section>

      <div class="consulta-ayuda">
        <form class="consulta-ayuda" action="" method="post">
          <label><h2>¿Te sirvio nuestra información?</h2></label><br>
          <input type="submit" class="respuesta-boton" value="si">
          <input type="submit" class="respuesta-boton" value="no"><br><br>
          <label><h2>Consultas:</h2></label><br>
          <textarea class="textarea_ayuda"name="" rows="2" cols="40" placeholder="Explique..."></textarea>
        </form>
      </div>
      </div>
  </div>
  <?php include_once 'includes/footer.php'; ?>
</body>
</html>
