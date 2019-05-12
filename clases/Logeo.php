<?php
/**
 *
 */
class Logeo{
    static public function iniciarSession(){
        if(!isset($_SESSION)){
            session_start();
        }
    }
    static public function  verificarPassword($password,$passwordHash){
        return password_verify($password,$passwordHash);
    }
    static public function seteoUsuario($user){
      $_SESSION["nombreUsuario"]=$user["nombreUsuario"];
      $_SESSION["email"]=$user["email"];
      $_SESSION["perfil"]=$user["perfil"];
      $_SESSION["foto"]=$user["foto"];
      $_SESSION["pais"]=$user["pais"];
      $_SESSION["fecharegistro"]=$user["fecharegistro"];
    }
    static public function seteoCookie($dato){
            setcookie("email",$dato["email"],time()+3600);
            setcookie("password",$dato["password"],time()+3600);
    }
    static public function validarUsuario(){
        if(isset($_SESSION["email"])){
            return true;
        }elseif (isset($_COOKIE["email"])) {
            $_SESSION["email"]=$_COOKIE["email"];
            return true;
        }else{
            return false;
        }
    }
    static public function seteoEditor($user,$bandera1){
      if($bandera1=== "avatar"){
        $_SESSION["foto"]=$user["foto"];
      }else{
        $_SESSION["nombreUsuario"]=$user["nombreUsuario"];
      }
    }
}
