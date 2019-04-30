<?php
 include_once("controladores/funciones-registracion.php");
   if ($_POST) {
     $errores= validar($_POST);
     if (count($errores)==0) {

       $usuario=checkearEmail($_POST["email"]);
       if ($usuario !==null){
           $errores["email"]= "El mail ingresado ya existe. Ingrese otro mail";
        }
       $usuario=checkearUsuario($_POST["nombre-de-usuario"]);
       if ($usuario !==null) {
          $errores["nombre-de-usuario"]= "El nombre de usuario ingresado ya exite. Ingrese otro nombre de usuario";
       }else {
         $foto= armarFoto($_FILES);
         $registro= armarRegistro($_POST, $foto);
         guardar($registro);

         header("location:index.php");
         exit;
       }


     }
   }

?>



<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css?family=Special+Elite" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Merienda:400,700" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="css/formularioslogin_registracion.css">
  <title>Formulario de Registración</title>
</head>
<body class=body_juegos>
  <header id="tope" class="encabezado">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark navbarra">
      <img class="logo" src="img/logo1.png" alt="logo_proyecto">
      <h2>Proyecto FloPaTin</h2>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-md-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Login<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="formularioDeRegistracion.php">Registrarse<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="inicio.php">Inicio <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="juego.php">Juegos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="perfil.php">Perfil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="ayuda.php">Ayuda</a>
          </li>
        </ul>
      </div>
      <img class="logo d-none d-md-block" src="img/logo.png" alt="logo_proyecto">
    </nav>
  </header>

  <div class="contener-fluid">

    <?php if(isset($errores)):
      echo "<ul class='alert alert-danger text-center'>";
      foreach ($errores as $key => $value) :?>
        <li><?=$value;?> </li>
      <?php endforeach;
      echo "</ul>";
      endif;?>

    <form class="formulario1" action="" method="post" enctype="multipart/form-data">
      <h2>Create una cuenta para sociabilizar y aprender</h2>
      <label for="nombre" class="label1">Nombre</label>
      <input type="text" name="nombre" value="<?=(isset($errores["nombre"]))?"" :persistir("nombre");?>" class="field">


      <label for="apellido" class="label1">Apellido</label>
      <input type="text" name="apellido" value="<?=(isset($errores["apellido"]))?"" :persistir("apellido");?>" class="field">

      <label for="nombre-de-usuario" class="label1">Nombre de Usuario</label>
      <input type="text" name="nombre-de-usuario" class="field" value="<?=(isset($errores["nombre-de-usuario"]))?"" :persistir("nombre-de-usuario");?>">

      <label for="email" class="label1">Mail de referencia</label>
      <input type="email" name="email" value="<?=(isset($errores["email"]))?"" :persistir("email");?>" class="field">

      <label for="password" class="label1">Contraseña</label>
      <input type="password" name="password" value="" class="field">
      <small id="passwordHelpInline" class="text-muted smallpass">
      Utiliza ocho caracteres como mínimo con una combinación de letras, números y símbolos
      </small><br><br>

      <label for="reconfi-password" class="label1">Reconfirmación de la contraseña</label>
      <input type="password" name="reconfi-password" value="" class="field">

      <label for="nacimiento" class="label1">Fecha de nacimiento</label>
      <input type="date" name="nacimiento" value="<?=(isset($errores["nacimiento"]))?"" :persistir("nacimiento");?>" class="field">
      <div class="sexo">
           <label for="sex" class="label1">Sexo</label><br>
           <input type="radio" name="sex" value="M" class="sexo">Masculino <br>
           <input type="radio" name="sex" value="F" class="sexo">Femenino
      </div>
      <br>
         <div class="pais">
           <label for="pais" class="label1">Pais</label>
           <select class="" name="pais">
             <option hidden value="">Seleccione su país</option>
             <optgroup label="America">
               <option value="Ar">Argentina</option>
               <option value="Br">Brasil</option>
               <option value="EEUU">Estados Unidos</option>
               <option value="Ca">Canada</option>
               <option value="Col">Colombia</option>
               <option value="Ve">Venezuela</option>
             </optgroup>
             <optgroup label="Europa">
               <option value="RU">Reino Unido</option>
               <option value="Esp">España</option>
               <option value="po">Portugal</option>
               <option value="Fr">Francia</option>
               <option value="It">Italia</option>
               <option value="German">Alemania</option>
               <option value="Hol">Holanda</option>
               <option value="Din">Dinamarca</option>
             </optgroup>
             <optgroup label="Africa">
               <option value="Sa">Sudafrica</option>
               <option value="CM">Costa de Marfil</option>
               <option value="Ke">Kenia</option>
               <option value="Camerun">Camerun</option>
               <option value="Nigeria">Nigeria</option>
             </optgroup>
             <optgroup label="Asia">
               <option value="ArabiaS">Arabia Saudita</option>
               <option value="Armenia">Armenia</option>
               <option value="Camboya">Camboya</option>
               <option value="Ch">China</option>
               <option value="CS">Corea del Sur</option>
               <option value="CN">Corea del Norte</option>
               <option value="Japon">Japon</option>
               <option value="Taiwan">Taiwan</option>
             </optgroup>
           </select>
         </div>
         <br>
         <div class="archivo">
            Archivo: <input type="file" name="foto" id="foto" value="<?=(isset($errores["foto"]))?"" :persistir("foto");?>">
         </div>

         <br>
        <button type="submit" class="bottonacceder">Registrarme</button>
        <ul class="listadeRegistro">
          <li class="Login"><a href="index.html">Ahora logueate!</a></li>
          </ul>
        </form>
      </div>
    <footer class="footer">
      <div class="contenedorfooter mt-4">
      <section class="sectionfooter">
           <ul class="container-fluid list-unstyled list-inline mb-0">
             <li class="list-inline-item">
              <p>Juega ahora en</p>
              <a href="https://facebook.com" target="_blank">
                <button class="bottoniconos" type="button" name="buttonf">
                <img src="img/fb.png" alt="facebook"></button></a>
            </li>
            <li class="list-inline-item">
              <p>Siguenos en</p>
              <a href="https://twitter.com" target="_blank">
                <button class="bottoniconos" type="button" name="buttont">
                <img src="img/Twitter.png" alt="twitter"></button></a>
            </li>
            <li class="list-inline-item">
              <p>Descargalo en el</p>
              <a href="https://itunes.apple.com" target="_blank">
                <button class="bottoniconos" type="button" name="buttoni">
                <img src="img/apple.png" alt="itunes"></button></a>
            </li>
            <li class="list-inline-item">
              <p>Disponible en</p>
              <a href="https://play.google.com" target="_blank">
                <button class="bottoniconos" type="button" name="buttong">
                <img src="img/Androi.png" alt="play-google"></button></a>
            </li>
            <li class="list-inline-item">
              <p>Ir arriba</p>
              <a href="#tope">
                <button class="bottoniconos" type="button" name="buttoni">
                <img src="img/unicornio.jpg" alt="inicio"></button></a>
            </li>
          </ul>
          </section>
          <section class="copyright">
              <small>© 2019 <strong>Proyecto FloPaTin</strong>. ¿Todos los derechos reservados? Nah. Patente Pendiente.</small>
         </section>
       </div>
     </footer>
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   </body>
   </html>
