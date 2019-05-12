<?php
/**
 *
 */
class Validador{
  public function validacionUsuario($usuario){
    $errores=array();
    $nombreUsuario = trim($usuario->getNombreUsuario());
    if(isset($nombreUsuario)){
        if(empty($nombreUsuario)){
            $errores["nombre-de-usuario"]= "Complete el campo con un nombre de usuario";
        }
    }

    $email = trim($usuario->getEmail());
    if (empty($email)) {
      $errores["email"]="Complete con su correo";
    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errores["email"]="Correo invalido";
    }

    $password = trim($usuario->getPass());
    $repassword = trim($usuario->getRePass());
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

     if ($usuario->getFoto()!=null) {
       if ($_FILES["foto"]["error"]!=UPLOAD_ERR_OK) {
         $errores["foto"]="Debe subir una foto";
       }else{
         $nombre=$_FILES["foto"]["name"];
         $ext= pathinfo($nombre, PATHINFO_EXTENSION);
         if ($ext !="jpg" && $ext !="png" && $ext !="jpeg") {
           $errores["foto"]="Debe ser un archivo jpg ó png ó jpeg";
         }
       }
     }
   return $errores;
  }
  public function validacionLogin($usuario){
    $errores_login=array();
    $field_email = trim($usuario->getEmail());
    if(!filter_var($field_email, FILTER_VALIDATE_EMAIL)){
      $errores_login["email"]="Por favor, coloque email válido.";
    }
    $password_login= trim($usuario->getPass());
    if(empty($password_login)){
      $errores_login["password"]= "Por favor, debe completar con su contraseña.";
    }
    return $errores_login;
  }
  public function validarOlvidar($usuario){
    $errores=array();
    $email=trim($usuario->getEmail());
    if (empty($email)) {
      $errores["email"]="Complete su mail";
    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errores["email"]="Email invalido";
    }

    $password = trim($usuario->getPass());
    $repassword = trim($usuario->getRePass());
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
  public function validar_configuracion($datos,$bandera1){
   $errores=array();
   if($bandera1 === "avatar"){
     if (isset($_FILES)) {
       if ($_FILES["foto"]["error"]!=UPLOAD_ERR_OK) {
         $errores["foto"]="Debe subir una foto";
       }else{
         $nombre=$_FILES["foto"]["name"];
         $ext= pathinfo($nombre, PATHINFO_EXTENSION);
         if ($ext !="jpg" && $ext !="png" && $ext !="jpeg") {
           $errores["foto"]="Debe ser un archivo jpg ó png ó jpeg";
         }
       }
     }
  }else{
    $nombreUsuario = trim($datos["nombre-de-usuario"]);
    if(isset($nombreUsuario)){
        if(empty($nombreUsuario)){
            $errores["nombre-de-usuario"]= "Complete el campo con un nombre de usuario";
        }
    }
  }
   return $errores;
  }
}
