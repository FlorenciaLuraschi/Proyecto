<?php
include_once 'includes/head.php';
// include_once 'controladores/validar_login.php';
// include_once 'controladores/validar_registro.php';
require_once("Autoload.php");
if($_POST){
  $conexion = "MYSQL";
//   if ($conexion == "JSON") {
//     $usuario = new Usuario($_POST["email"],$_POST["password"]);
//     $errores_login = $validar->validacionLogin($usuario);
//
//   if(count($errores_login) == 0){
//     $usuarioEncontrado = $json->checkearEmail($usuario->getEmail());
//     if ($usuarioEncontrado == null) {
//       $errores_login["email"]="Usuario no registrado";
//     }else{
//       if(Logeo::verificarPassword($usuario->getPass(),$usuarioEncontrado["password"])===false){
//         $errores_login["password"]="Error en los datos verifique.";
//       }else{
//         Logeo::seteoUsuario($usuarioEncontrado);
//         if(isset($_POST["recordar"])){
//             Logeo::seteoCookie($usuarioEncontrado);
//           }
//       if (Logeo::validarUsuario()) {
//           redirect("inicio.php");
//         }else {
//           redirect("formularioDeRegistracion.php");
//         }
//       }
//     }
//   }
// } else {
  $usuario = new Usuario($_POST["email"],$_POST["password"]);
  $errores_login = $validar->validacionLogin($usuario);

if(count($errores_login) == 0){
  $usuarioEncontrado = BaseMysql::checkearPorEmail($usuario->getEmail(), $pdo, 'users');
  if ($usuarioEncontrado == false) {
    $errores_login["email"]="Usuario no registrado";
  }else{
    if(Logeo::verificarPassword($usuario->getPass(),$usuarioEncontrado["password"])===false){
      $errores_login["password"]="Error en los datos verifique.";
    }else{
      Logeo::seteoUsuario($usuarioEncontrado);
      if(isset($_POST["recordar"])){
          Logeo::seteoCookie($_POST);
    }
    if (Logeo::validarUsuario()) {
        redirect("inicio.php");
      }else {
        redirect("formularioDeRegistracion.php");
      }
    }
  }
}
}
//}
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
          <input type="email" name="email" value="<?=(isset($errores["email"]))? "":persistir("email");?>" class="field" placeholder="ejemplo@dominio.com" required><br>
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
              <input class="form-check-input" name="recordar" type="checkbox" id="recordarme" value="recordar">
              <label class="form-check-label label1" for="recordar">
                Recordame
              </label>
            </div>
          </div>
          <div class="olvidoPassword">
              <label for="olvido-su-contrasenia">
                <a href="formolvidarcontrasenia.php">¿Ólvido su contraseña?</a>
              </label>
          </div>
          <div class="col-auto my-1">
            <button type="submit" class="bottonacceder">Iniciar sesión</button>
          </div>
            <ul class="listadeRegistro">
              <li class="Registrese"><a href="formularioDeRegistracion.php">¿Todavía no estás registrado?</a></li>
            </ul>
      </form>
      </div>
    <?php include_once 'includes/footer.php' ?>

  </body>

</html>
