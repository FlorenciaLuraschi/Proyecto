<?php
include_once 'includes/head.php';
// include_once 'controladores/validar_login.php';
// include_once 'controladores/validar_registro.php';
require_once("Autoload.php");
if($_POST){
  $usuario = new Usuario($_POST["email"],$_POST["password"],$_POST["reconfi-password"]);
  $errores= $validar->validarOlvidar($usuario);
if(count($errores) == 0){
  $usuarioEncontrado = $json->checkearEmail($usuario->getEmail());

  if ($usuarioEncontrado == null) {
    $errores["email"]="Usuario no registrado";
  }else{
    $registro = $json->jsonOlvidarpass($usuario->getEmail(),$usuario->getPass());
    redirect("nuevopass.php");
      }
    }
  }

?>
<title>Proyecto FloPaTin-Cambio de Contraseña</title>
</head>
  <body>
    <div class="container-fluid p-0 body_login">
    <header id="tope" class="encabezado">
      <?php include_once 'includes/navbar.php'; ?>
      <?php include_once 'includes/carrusel.php'; ?>
    </header>

        <form class="formlogin" action="" method="post" enctype= "multipart/form-data">
          <h2>Recuperar Contraseña</h2>
          <label for="email" class="label1">Correo electrónico</label><br>
          <input type="email" name="email" value="<?=isset($errores["email"])? "":persistir("email") ;?>" class="field" placeholder="ejemplo@dominio.com" required><br>
          <?php if(isset($errores["email"])):?>
            <span class="error_login">
              <?php echo $errores["email"];?>
            </span>
          <?php endif;?>
          <br><br>
          <label for="password" class="label1">Nueva Contraseña</label><br>
          <input type="password" name="password" value="" class="field" required><br>
          <?php if(isset($errores["password"])):?>
            <span class="error_login">
              <?php echo $errores["password"];?>
            </span>
          <?php endif;?>
          <br><br>
          <label for="reconfi-password" class="label1">Reconfirmación de la contraseña</label><br>
          <input type="password" name="reconfi-password" value="" class="field" required><br>
          <?php if(isset($errores["repassword"])):?>
            <span class="error_login">
              <?php echo $errores["repassword"];?>
            </span>
          <?php endif;?>
          <br><br>
          <div class="col-auto my-1">
            <button type="submit" class="bottonacceder">Enviar</button>
          </div>
      </form>
      </div>
    <?php include_once 'includes/footer.php' ?>

  </body>

</html>
