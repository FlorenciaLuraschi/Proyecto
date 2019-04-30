<?php
include_once 'includes/head.php';
include_once 'controladores/validar_login.php';
if(!isset($_SESSION["email"])) {
    header("location:index.php");
    exit;
}
?>
<title>Proyecto FloPaTin-Inicio</title>
</head>
<body class=body-inicio>
  <header id="tope" class="encabezado">
    <?php include_once 'includes/navbar_user.php'; ?>
    <?php include_once 'includes/carrusel.php'; ?>
  </header>
  <div class="container p-0">
    <section class="secciongral">
      <div class="row contenedorprincipal">
        <article class="tablaposiciones col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
          <p class="ayudas">A modo de ayuda para la visualización del sitio. En esta sección va el listado de los mejores 20 en el juego</p>
        </article>
         <article class="chatgeneral col-xs-12 col-sm-12 col-md-7 col-lg-7 col-xl-7">
           <form  action="" method="POST">
             <div class="form-group">
               <textarea class="form-control estilotextarea" id="FormControlTextarea" rows="3" cols="60" placeholder="Agrega un comentario..."></textarea>
             </div>
             <button class="bottoncomentario" type="submit">Enviar</button>
           </form>
           <br>
           <br>
           <p class="ayudas">En esta sección de la pagina la idea es que se puendan ir publicando los comentarios. Quedando como una sala de chat general y así poder hablar entre todos.</p>
             <div class="media">
             <img class="d-flex rounded-circle avatar z-depth-1-half mr-3" src="imagenes/<?=$_SESSION["foto"];?>"
               alt="Avatar">
             <div class="media-body chatejemplo">
               <h5><?=$_SESSION["nombreUsuario"];?></h5>
               Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus
               odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate
               fringilla. Donec lacinia congue felis in faucibus.
             <div class="media mt-3 shadow-textarea">
                 <img class="d-flex rounded-circle avatar z-depth-1-half mr-3" src="https://mdbootstrap.com/img/Photos/Avatars/avatar-8.jpg"
                   alt="Generic placeholder image">
                 <div class="media-body chatejemplo">
                   <h5>Danny Tatuum</h5>
                   <div class="form-group basic-textarea rounded-corners">
                     <textarea class="form-control estilotextareaejemplo" id="ejemploTextareaChat" rows="1" placeholder="Escribe una respuesta..."></textarea>
                   </div>
                 </div>
               </div>
             </div>
           </div>
           <div class="media mt-4">
             <img class="d-flex rounded-circle avatar z-depth-1-half mr-3" src="https://mdbootstrap.com/img/Photos/Avatars/avatar-10.jpg"
               alt="Avatar">
             <div class="media-body chatejemplo">
               <h5>Caroline Horwitz</h5>
               Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis odit minima eaque dignissimos recusandae
               officiis commodi nulla est, tempore atque voluptas non quod maxime, iusto, debitis aliquid? Iure ipsum,
               itaque.
             </div>
           </div>
         </article>
         <article class="miembrosvisibles col-md-2 col-lg-2 col-xl-2 d-none d-md-block">
           <p class="ayudas">A modo de ayuda para la visualización del sitio. En esta sección va la tabla que muestra usuarios conetactados</p>
         </article>
      </div>
     </section>
   </div>
   <?php include_once 'includes/footer.php' ?>

</body>
</html>
