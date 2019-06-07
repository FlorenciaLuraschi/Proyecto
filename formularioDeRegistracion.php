<?php
include_once 'includes/head.php';
// include_once("controladores/validar_registro.php");
// include_once("controladores/validar_login.php");
require_once("Autoload.php");

$paises= BaseMysql::paises($pdo);
if ($_POST) {
  $conexion = "MYSQL";
  // if ($conexion== "JSON") {
  //   $usuario= new Usuario($_POST["email"],$_POST["password"],$_POST["reconfi-password"],$_POST["nombre-de-usuario"],$_POST["pais"],$_FILES);
  //   $errores=$validar->validacionUsuario($usuario);
  //   if (count($errores)==0) {
  //     $usuarioEncontrado = $json->checkearEmail($usuario->getEmail());
  //     if ($usuarioEncontrado !==null){
  //         $errores["email"] = "El mail ingresado ya existe. Ingrese otro mail";
  //       }
  //      $usuarioEncontrado = $json->checkearUsuario($usuario->getNombreUsuario());
  //      if ($usuarioEncontrado !==null) {
  //         $errores["nombre-de-usuario"]= "El nombre de usuario ingresado ya exite. Ingrese otro nombre de usuario";
  //     }else{
  //       $foto = $registro->armarFoto($usuario->getFoto());
  //       $registroUsuario = $registro->armarUsuario($usuario, $foto);
  //       $json->guardar($registroUsuario);
  //       redirect("index.php");
  //     }
  //   }
  // } else{
  $usuario= new Usuario($_POST["email"],$_POST["password"],$_POST["reconfi-password"],$_POST["nombre-de-usuario"],$_POST["pais"],$_FILES);
  $errores=$validar->validacionUsuario($usuario);
  if (count($errores)==0) {
    $usuarioEncontrado =BaseMysql::checkearPorEmail($usuario->getEmail(), $pdo, 'users');

    if ($usuarioEncontrado){
      $errores["email"] = "El mail ingresado ya existe. Ingrese otro mail";
    }

    $usuarioEncontrado = BaseMysql::checkearUsuario($usuario->getNombreUsuario(), $pdo, 'users' );

    if ($usuarioEncontrado) {
      $errores["nombre-de-usuario"]= "El nombre de usuario ingresado ya existe. Ingrese otro nombre de usuario";
    }else{
      $foto = $registro->armarFoto($usuario->getFoto());
      $usuario->setFoto($foto);
      BaseMysql::guardarUsuario($pdo, $usuario, 'users');

      redirect("index.php");
    }
  }
  //  }
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
        <h2>Registrate en nuestra comunidad para jugar</h2>
        <!-- <label for="nombre" class="label1">Nombre</label>
          <input type="text" name="nombre" value="<?=(isset($errores["nombre"]))?"" :persistir("nombre");?>" class="field">

          <label for="apellido" class="label1">Apellido</label>
          <input type="text" name="apellido" value="<?=(isset($errores["apellido"]))?"" :persistir("apellido");?>" class="field"> -->

          <label for="nombre-de-usuario" class="label1">Nombre de Usuario</label>
          <input type="text" name="nombre-de-usuario" class="field" value="<?=(isset($errores["nombre-de-usuario"]))?"" :persistir("nombre-de-usuario");?>">

          <label for="email" class="label1">Correo de referencia</label>
          <input type="email" name="email" value="<?=(isset($errores["email"]))?"" :persistir("email");?>" class="field">

          <label for="password" class="label1">Contraseña</label>
          <input type="password" name="password" value="" class="field">
          <small id="passwordHelpInline" class="text-muted smallpass">
            Utiliza 8 caracteres como mínimo combiando letras y números.
          </small><br><br>

          <label for="reconfi-password" class="label1">Reconfirmación de la contraseña</label>
          <input type="password" name="reconfi-password" value="" class="field">

          <!-- <label for="nacimiento" class="label1">Fecha de nacimiento</label>
            <input type="date" name="nacimiento" value="<?=(isset($errores["nacimiento"]))?"" :persistir("nacimiento");?>" class="field">
            <div class="sexo">
              <label for="sex" class="label1">Sexo</label><br>
              <input type="radio" name="sex" value="M" class="sexo">Masculino <br>
              <input type="radio" name="sex" value="F" class="sexo">Femenino
            </div> -->
            <br>
            <div class="pais">
              <label for="pais" class="label1">Pais</label>
              <select class="" name="pais">
                <option hidden value="">Seleccione su país</option>
                <?php foreach ($paises as $key=> $value) : ?>
                <option value="<?=$value["id"]?>"><?= $value["nombre"] ?></option>
                <?php endforeach;?>

                <!-- <optgroup label="America">
                  <option value="1">Argentina</option>
                  <option value="Bolivia">Bolivia</option>
                  <option value="Brasil">Brasil</option>
                  <option value="Chile">Chile</option>
                  <option value="Colombia">Colombia</option>
                  <option value="Costa Rica">Costa Rica</option>
                  <option value="Cuba">Cuba</option>
                  <option value="Ecuador">Ecuador</option>
                  <option value="El Salvador">El Salvador</option>
                  <option value="Guatemala">Guatemala</option>
                  <option value="Honduras">Honduras</option>
                  <option value="Mexico">México</option>
                  <option value="Nicaragua">Nicaragua</option>
                  <option value="Panamá">Panamá</option>
                  <option value="Paraguay">Paraguay</option>
                  <option value="Puerto Rico">Puerto Rico</option>
                  <option value="Perú">Perú</option>
                  <option value="República Dominicana">República Dominicana</option>
                  <option value="Uruguay">Uruguay</option>
                  <option value="Venezuela">Venezuela</option>
                </optgroup>
                <optgroup label="Europa">
                  <option value="España">España</option> --> -->
                  <!-- <option value="Portugal">Portugal</option> -->
                  <!--<option value="Francia">Francia</option>
                    <option value="Italia">Italia</option>
                    <option value="Alemania">Alemania</option>
                    <option value="Holanda">Holanda</option>
                    <option value="Dinamarca">Dinamarca</option> -->
                    <!--</optgroup>
                      <!-- <optgroup label="Africa">
                        <option value="Sudafrica">Sudafrica</option>
                        <option value="Kenia">Kenia</option>
                        <option value="Camerun">Camerun</option>
                        <option value="Nigeria">Nigeria</option>
                      </optgroup> -->
                      <!--<optgroup label="Asia">
                        <option value="ArabiaS">Arabia Saudita</option>
                        <option value="Armenia">Armenia</option>
                        <option value="Camboya">Camboya</option>
                        <option value="China">China</option>
                        <option value="Japon">Japon</option>
                        <option value="Taiwan">Taiwan</option>
                      </optgroup> -->
                      <!-- </select> -->
                      <!-- </div> -->
                      <br>
                      <div class="archivo">
                        Archivo: <input type="file" name="foto" id="foto" value="<?=(isset($errores["foto"]))?"" :persistir("foto");?>">
                      </div>
                      <br>
                      <button type="submit" class="bottonacceder">Registrarme</button>
                      <!-- <ul class="listadeRegistro">
                        <li class="Login"><a href="index.php">Ahora logueate!</a></li>
                      </ul> -->
                    </form>

                    <?php include_once 'includes/footer.php' ?>
                  </div>
                </body>
                </html>
