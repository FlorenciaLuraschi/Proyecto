<?php
//include_once("controladores/validar_login.php");
include_once 'includes/head.php';
//include_once 'controladores/validar_registro.php';
require_once("Autoload.php");
if(!isset($_SESSION["email"])) {
    header("location:index.php");
    exit;
}
//identifico que se envio info del formulario
if($_POST){
//intento determinar si viene de querer cambiar foto o nombre
//nota: ver de verificar tamaño o peso también?

  if($_POST['form']=="form1"){//nos nos permite identificar si la información
  $bandera1="avatar";//para poder identificar cual de las validaciones hay que hacer uso la bandera
  $errores= $validar->validar_configuracion($_POST,$bandera1);
    if(count($errores)==0){
      $usuario=$json->checkearEmail($_SESSION["email"]);
      $foto= $registro->armarFoto($_FILES);
      $registroUsuario=$json->cambioFoto($_SESSION["email"],$foto);

      Logeo::seteoEditor($usuario,$bandera1);
      redirect("perfil.php");
    }
  }elseif ($_POST['form']=="form2") {
    $bandera1="nombre";
    $errores= $validar->validar_configuracion($_POST,$bandera1);
      if(count($errores)==0){
        $usuario=$json->checkearEmail($_SESSION["email"]);
        $registroUsuario=$json->cambioNombre($_SESSION["email"], $_POST["nombre-de-usuario"]);
        Logeo::seteoEditor($usuario,$bandera1);
        redirect("perfil.php");
  }
  }
}
?>

<title>Proyecto FloPaTin-Configuración</title>
</head>
<body class=body-perfil>
  <header id="tope" class="encabezado">
    <?php include_once 'includes/navbar_user.php'; ?>
  </header>

  <div class="container-fluid">
    <div class="contenedor_perfil">
      <section>
        <div class="maxwidth_configuracion">

            <!--foto de perfil-->
            <div class="card targeta_perfil">
              <div class="foto_usuario">
                <img src="imagenes/<?=$_SESSION["foto"];?>" class="card-img-top" alt="">
                <div class="p-0 formavatar">
                  <form  action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="form" value="form1">
                    <div class="archivo_edit">
                     <input type="file" name="foto" id="foto" value="<?=(isset($errores["foto"]))?"" :persistir("foto");?>">
                     <br>
                     <?php if(isset($errores["foto"])):?>
                       <span class="errorperfil">
                         <?php echo $errores["foto"];?>
                       </span>
                     <?php endif;?>
                    </div>
                    <button class="bottoneditar bottonavatar" type="submit">Editar</button>
                  </form>
                </div>
              </div>
              <div class="card-body cuadroperfil1 p-0">
                <div class="editar">
                  <h5 class="card-title"><?=$_SESSION["nombreUsuario"];?></h5>
                  <div class="p-0">
                  <form  action="" method="POST">
                    <input type="hidden" name="form" value="form2">
                    <input type="text" name="nombre-de-usuario" class="field editinput" value="">
                    <br>
                    <?php if(isset($errores["nombre-de-usuario"])):?>
                      <span class="errorperfil">
                        <?php echo $errores["nombre-de-usuario"];?>
                      </span>
                    <?php endif;?>
                    <button class="bottoneditar bottonnombre" type="submit">Editar</button>
                  </form>
                </div>
                </div>
              </div>
            </div>

        </div>
      </section>
    </div>
  </div>
  <?php include_once 'includes/footer.php' ?>
</body>
</html>
