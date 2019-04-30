<?php
include_once 'includes/head.php';
include_once("controladores/validar_registro.php");
include_once("controladores/validar_login.php");

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


<title>Proyecto FloPaTin-Registración</title>
</head>
<body>
  <div class="contener-fluid body_registro p-0">
  <header id="tope" class="encabezado">
    <?php include_once 'includes/navbar.php'; ?>
  </header>
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
               <option value="Argentina">Argentina</option>
               <option value="Brasil">Brasil</option>
               <option value="Mexico">México</option>
               <option value="Canada">Canada</option>
               <option value="Colombia">Colombia</option>
               <option value="Venezuela">Venezuela</option>
             </optgroup>
             <optgroup label="Europa">
               <option value="España">España</option>
               <option value="Portugal">Portugal</option>
               <option value="Francia">Francia</option>
               <option value="Italia">Italia</option>
               <option value="Alemania">Alemania</option>
               <option value="Holanda">Holanda</option>
               <option value="Dinamarca">Dinamarca</option>
             </optgroup>
             <optgroup label="Africa">
               <option value="Sudafrica">Sudafrica</option>
               <option value="Kenia">Kenia</option>
               <option value="Camerun">Camerun</option>
               <option value="Nigeria">Nigeria</option>
             </optgroup>
             <optgroup label="Asia">
               <option value="ArabiaS">Arabia Saudita</option>
               <option value="Armenia">Armenia</option>
               <option value="Camboya">Camboya</option>
               <option value="China">China</option>
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
          <li class="Login"><a href="index.php">Ahora logueate!</a></li>
          </ul>
        </form>

    <?php include_once 'includes/footer.php' ?>
    </div>
   </body>
   </html>
