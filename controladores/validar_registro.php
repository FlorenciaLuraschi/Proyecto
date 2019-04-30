<?php
  function validar($datos){
   $errores=[];

   $nombre= trim($datos["nombre"]);
   if (empty($nombre)) {
      $errores["nombre"]="Complete el campo con su nombre";
   }

   $apellido= trim($datos["apellido"]);
   if (empty($apellido)) {
     $errores["apellido"]="Complete el campo con su apellido";
   }

   $nombreUsuario=trim($datos["nombre-de-usuario"]);
   if (empty($nombreUsuario)) {
     $errores["nombre-de-usuario"]= "Complete el campo con un nombre de usuario";
   }

   $email=trim($datos["email"]);
   if (empty($email)) {
     $errores["email"]="Complete su mail";
   }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
     $errores["email"]="Email invalido";
   }

   $password= trim($datos["password"]);
   $repassword= trim($datos["reconfi-password"]);
   if (empty($password)) {
     $errores["password"]="Complete su contraseña";
   }elseif (strlen($password)<8) {
     $errores["password"]="La contraseña debe tener minimo 8 caracteres";
   }elseif (!preg_match('/[a-z]/', $password)) {
     $errores["password"]="La contraseña deber contener al menos una letra";
   }elseif (!preg_match('/[0-9]/', $password)) {
     $errores["password"]="La contraseña deber contener al menos un numero";
   }elseif ($password!=$repassword) {
     $errores["reconfi-password"]="No coinciden las contraseñas";
   }


   if (isset($_FILES)) {
    if ($_FILES["foto"]["error"]!=UPLOAD_ERR_OK) {
      $errores["foto"]="Debe subir una foto";
    }
    $nombre=$_FILES["foto"]["name"];
    $ext= pathinfo($nombre, PATHINFO_EXTENSION);
    if ($ext !="jpg" && $ext !="png") {
      $errores["foto"]="Debe ser un archivo jpg ó png";
    }
  }
   return $errores;
 }

function persistir($campo){
  if (isset($_POST[$campo])) {
    return $_POST[$campo];
  }
}

function armarFoto($imagen){ /*amar la ruta para guadar el archivo*/
  $nombre = $imagen["foto"]["name"];
  $ext=pathinfo($nombre, PATHINFO_EXTENSION);
  $archivoOrigen= $imagen["foto"]["tmp_name"];
  $archivoDestino= dirname(__DIR__);
  $archivoDestino=$archivoDestino."/imagenes/";
  $foto=uniqid();
  $archivoDestino= $archivoDestino . $foto;
  $archivoDestino=$archivoDestino."." .$ext;
  move_uploaded_file($archivoOrigen, $archivoDestino);
  $foto= $foto. "." . $ext;
  return $foto;
}

function armarRegistro($datos, $imagen){
  setlocale(LC_TIME,"es_ES");
  $fecharegistro=ucfirst(strftime("%B %Y",time()));
  $usuario=[
    "nombre"=> $datos["nombre"],
    "apellido"=> $datos["apellido"],
    "nombreUsuario"=>$datos["nombre-de-usuario"],
    "email"=>$datos["email"],
    "password"=>password_hash($datos["password"], PASSWORD_DEFAULT),
    "foto"=>$imagen,
    "pais"=>$datos["pais"],
    "fecharegistro"=>$fecharegistro,
    "perfil"=>1
  ];
  return $usuario;
}

function guardar($usuario){
  $jsusuario= json_encode($usuario);
  file_put_contents("usuarios.json", $jsusuario.PHP_EOL, FILE_APPEND);
}

function checkearEmail($email){
  $usuarios= abrirBaseDatos();
  if($usuarios !==null){
    foreach($usuarios as $usuario){
     if ($email== $usuario["email"]) {
         return $usuario;
      }
    }
   }
   return null;
}

function checkearUsuario($nombreUsuario){
  $usuarios= abrirBaseDatos();
  if($usuarios !==null){
    foreach($usuarios as $usuario){
     if ($nombreUsuario== $usuario["nombreUsuario"]) {
         return $usuario;
      }
    }
   }
   return null;
}

<<<<<<< HEAD:controladores/funciones-registracion.php
function abrirBaseDatos(){
if (file_exists("usuarios.json")) {
  $baseDatosJson= file_get_contents("usuarios.json");
  $baseDatosJson= explode(PHP_EOL, $baseDatosJson);
    array_pop($baseDatosJson);
    foreach ($baseDatosJson as $usuarios) {
      $arrayUsuarios[]=json_decode($usuarios, true);
}
    return $arrayUsuarios;
  }else {
    return null;
  }

}
=======

>>>>>>> 7a8f19c4f884cd9ed9482e245af58447293d6cd2:controladores/validar_registro.php

 ?>
