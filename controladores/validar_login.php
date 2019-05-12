<?php
session_start();
function dd($valor){
    echo "<pre>";
        var_dump($valor);
        exit;
    echo "</pre>";
}

//primero sanetizamos/limpiamos el campo del email, que no contenga
//especios o caracteres prohibidos como puede ser codigo html que
//perjudique nuestra base de datos o de alguna forma la pagina.
function validar_login($datos){
    $errores_login=[];

    //1ero. sanetizamos la dirección de correo, verifica que sea una dirección valida y que
    //no tenga especios en blanco
    $field_email=trim($datos["email"]); //si todo está bien tengo la variable email filtrada y sanetizada

    //2do.validamos el correo, pues necesito compararlo en mi base de datos para
    //determinar luego si es un usuario registrado o no y si coloca mal la dirección
    //la busqueda sería desechada
    if(!filter_var($field_email, FILTER_VALIDATE_EMAIL)){
          $errores_login["email"]="Por favor, coloque email válido.";
    }
    //dejamos el error de espacio en blanco para el registro y con ayuda de la propia etiqueta
    //html input required obligamos al usuario a completar el campo y no dejarlo vacio.

    //Para la contraseña solo sacamos especio en blanco y comprobamos que no sea una variable vacia.
    $password_login= trim($datos["password"]);
    if(empty($password_login)){
        $errores_login["password"]= "Por favor, debe completar con su contraseña.";
    }

  return $errores_login;
}


//ahora verificamos que el usuario que se quiere logear se encuentre en nuestra base de Datos
//y si es así poder traer sus datos de sessión.

//tengo la funcion para abrir la base de datos
function abrirBaseDatos(){//sin parametros, armo una funcion para abrir el archivo json
  if(file_exists("usuarios.json")){
  $baseDatosJson=file_get_contents("usuarios.json");//atrapamos el archivo json,pero me da todo un reglon vacio, que lo tomaria como otro usuarui
  $baseDatosJson= explode(PHP_EOL,$baseDatosJson); //primero genera la posición 0 todos los datos, en la dos (1) pone el espacio vacio
  array_pop($baseDatosJson);
  foreach ($baseDatosJson as $usuarios) {
    //voy generando el array asociativo con todos los datos del Usuario
    $arrayUsuarios[]=json_decode($usuarios,true);//tenemos nuesta base de datos armada en un array asociativo
  }
  return $arrayUsuarios; //esto ahora va hacia la variable usuario, se hizo un generico para abrir archivos json
}else{
  return null;
}
}

//funcion que busca el correo y comparo en mi base de datos si existe
function buscarEmail($email){
  $usuarios=abrirBaseDatos();
  if ($usuarios!=null) {
    foreach ($usuarios as $usuario) {
      if($email === $usuario["email"]){
        return $usuario;
      }
    }
  }
  return null;
}

//ahora debo hacer una función para que si encontró al usuario extraer sus datos
function seteoUsuario($user,$dato){
  $_SESSION["nombreUsuario"]=$user["nombreUsuario"];
  $_SESSION["email"]=$user["email"];
  $_SESSION["perfil"]=$user["perfil"];
  $_SESSION["foto"]=$user["foto"];
  $_SESSION["pais"]=$user["pais"];
  $_SESSION["fecharegistro"]=$user["fecharegistro"];
  //recuerda la sesión por una hora
  if(isset($dato["recordar"])){
    setcookie("email",$dato["email"],time()+3600);
    setcookie("password",$dato["password"],time()+3600);
  }
}

function validarUsuario(){
    if($_SESSION["email"]){
        return true;
    }elseif ($_COOKIE["email"]) {
        $_SESSION["email"]=$_COOKIE["email"];
        return true;
    }else{
        return false;
    }
}

function olvidarpass($datos){
    $usuarios = abrirBaseDatos();
    foreach ($usuarios as $key=>$usuario) {
        if($datos["email"]==$usuario["email"]){
            $usuario["password"]= password_hash($datos["password"],PASSWORD_DEFAULT);
            $usuarios[$key] = $usuario;
        }
        $usuarios[$key] = $usuario;
    }

    unlink("usuarios.json");
    foreach ($usuarios as  $usuario) {
        $jsusuario = json_encode($usuario);
        file_put_contents('usuarios.json',$jsusuario. PHP_EOL,FILE_APPEND);
    }
}

function validarOlvidar($datos){
 $errores=[];

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
 return $errores;
}

function validar_configuracion($datos,$bandera1){
 $errores=[];
 if($bandera1 === "avatar"){
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
}else{
  $nombreUsuario=trim($datos["nombre-de-usuario"]);
  if (empty($nombreUsuario)) {
    $errores["nombre-de-usuario"]= "Complete el campo con un nombre de usuario";
  }
}
 return $errores;
}

function cambioFoto($datos, $foto){
  $usuarios = abrirBaseDatos();
  foreach ($usuarios as $key=>$usuario){
      if($datos==$usuario["email"]){
        unlink("imagenes/".$usuario["foto"]);
          $usuario["foto"]= $foto;
          $usuarios[$key] = $usuario;
      }
      $usuarios[$key] = $usuario;
  }
    unlink("usuarios.json");
    foreach ($usuarios as  $usuario) {
        $jsusuario = json_encode($usuario);
        file_put_contents('usuarios.json',$jsusuario. PHP_EOL,FILE_APPEND);
    }
}
function cambioNombre($datos,$nuevoNombre){
    $usuarios = abrirBaseDatos();
    foreach ($usuarios as $key=>$usuario) {
      if($datos==$usuario["email"]){
      $usuario["nombreUsuario"]= $nuevoNombre;
      $usuarios[$key] = $usuario;
  }
      $usuarios[$key] = $usuario;
    }

    unlink("usuarios.json");
    foreach ($usuarios as  $usuario) {
        $jsusuario = json_encode($usuario);
        file_put_contents('usuarios.json',$jsusuario. PHP_EOL,FILE_APPEND);
    }
}
//una vez hecho el cambio en la base de datos se debe volver a setear los datos cambiados
//asi se pueden ver los cambios en el momento
function seteoEditor($user,$bandera1){
  if($bandera1=== "avatar"){
    $_SESSION["foto"]=$user["foto"];
  }else{
    $_SESSION["nombreUsuario"]=$user["nombreUsuario"];
  }
}
