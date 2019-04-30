<?php
include_once 'includes/head.php';
include_once 'controladores/validar_login.php';
include_once 'controladores/validar_registro.php';
if($_POST){
  $errores_login= validar_login($_POST);

if(count($errores_login)==0){
  $usuario=buscarEmail($_POST["email"]);

  if ($usuario==null) {
    $errores_login["email"]="Usuario no registrado";
  }else{
    if (password_verify($_POST["password"],$usuario["password"])===false){
      $errores_login["password"]="Error en los datos verifique.";
    }else{
      seteoUsuario($usuario,$_POST);
    if (validarUsuario()) {
        header("location:inicio.php");
        exit;
      }else {
        header("location:formularioDeRegistracion.php");
        exit;
      }
    }
  }
}
}
?>
<title>Proyecto FloPaTin-Login</title>
</head>
  <body>
    <div class="container-fluid p-0 body_login">
    <header id="tope" class="encabezado">
      <?php include_once 'includes/navbar.php'; ?>
      <?php include_once 'includes/carrusel.php'; ?>
    </header>

        <form class="formlogin" action="" method="post">
          <h2>Log in</h2>
          <label for="email" class="label1">Correo electrónico</label><br>
          <input type="email" name="email" value="<?=isset($errores["email"])? "":persistir("email") ;?>" class="field" placeholder="ejemplo@dominio.com" required><br>
          <?php if(isset($errores_login["email"])):?>
            <span class="error_login">
              <?php echo $errores_login["email"];?>
            </span>
          <?php endif;?>
          <br><br>
          <label for="password" class="label1">Contraseña</label><br>
          <input type="password" name="password" value="" class="field" required><br>
          <?php if(isset($errores_login["password"])):?>
            <span class="error_login">
              <?php echo $errores_login["password"];?>
            </span>
          <?php endif;?>
          <br><br>
          <div class="col-auto my-1">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="autoSizingCheck2">
              <label class="form-check-label label1" for="autoSizingCheck2">
                Recordame
              </label>
            </div>
          </div>
          <div class="olvidoPassword">
            <a href="formolvidarcontrasenia.php">
              <label for="olvido-su-contrasenia">¿Ólvido su contraseña?</label>
            </a>
          </div>
          <div class="col-auto my-1">
            <button type="submit" class="bottonacceder">Iniciar sesión</button>
          </div>
            <ul class="listadeRegistro">
              <li class="Registrese"><a href="formularioDeRegistracion.php">¿Todavía no estás registrados?</a></li>
            </ul>
      </form>
      </div>
    <?php include_once 'includes/footer.php' ?>

  </body>

</html>
