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
