<?php
/**
 *
 */
class BaseJSON extends BaseDatos{
  private $nombreArchivo;
  public function __construct($nombreArchivo){
    $this->nombreArchivo=$nombreArchivo;
  }
  public function getNombrearchivo(){
    return $this->nombreArchivo;
  }
  public function setNombrearchivo($nombreArchivo){
    $this->nombreArchivo=$nombreArchivo;
  }
  public function guardar($registro){
    $jsusuario = json_encode($registro);
    file_put_contents($this->nombreArchivo,$jsusuario. PHP_EOL, FILE_APPEND);
  }
  public function abrirBaseDatos(){
    if(file_exists($this->nombreArchivo)){
    $baseDatosJson=file_get_contents($this->nombreArchivo);
    $baseDatosJson= explode(PHP_EOL,$baseDatosJson);
    array_pop($baseDatosJson);
    foreach ($baseDatosJson as $usuarios) {
      $arrayUsuarios[]=json_decode($usuarios,true);
    }
    return $arrayUsuarios;
  }else{
    return null;
  }
  }
  public function checkearEmail($email){
    $usuarios = $this->abrirBaseDatos();
    if($usuarios !==null){
      foreach($usuarios as $usuario){
       if ($email === $usuario["email"]) {
           return $usuario;
        }
      }
     }
     return null;
  }
  public function checkearUsuario($nombreUsuario){
    $usuarios= $this->abrirBaseDatos();
    if($usuarios !==null){
      foreach($usuarios as $usuario){
       if ($nombreUsuario== $usuario["nombreUsuario"]) {
           return $usuario;
        }
      }
     }
     return null;
  }
  public function jsonOlvidarpass($email,$password){
    $usuarios = $this->abrirBaseDatos();
    foreach ($usuarios as $key=>$usuario) {
      if($email==$usuario["email"]){
        $usuario["password"]= Encriptar::hashPassword($password);
        $usuarios[$key] = $usuario;
      }
      $usuarios[$key] = $usuario;
    }
    $this->borrar();
    foreach ($usuarios as  $usuario) {
        $jsusuario = json_encode($usuario);
        file_put_contents('usuarios.json',$jsusuario. PHP_EOL,FILE_APPEND);
    }
  }
  public function cambioFoto($datos, $foto){
    $usuarios = $this->abrirBaseDatos();
    foreach ($usuarios as $key=>$usuario){
        if($datos==$usuario["email"]){
          unlink("imagenes/".$usuario["foto"]);
            $usuario["foto"]= $foto;
            $usuarios[$key] = $usuario;
        }
        $usuarios[$key] = $usuario;
    }
    $this->borrar();
    foreach ($usuarios as  $usuario) {
        $jsusuario = json_encode($usuario);
        file_put_contents('usuarios.json',$jsusuario. PHP_EOL,FILE_APPEND);
    }
  }
  public function cambioNombre($datos,$nuevoNombre){
      $usuarios = $this->abrirBaseDatos();
      foreach ($usuarios as $key=>$usuario) {
        if($datos==$usuario["email"]){
        $usuario["nombreUsuario"]= $nuevoNombre;
        $usuarios[$key] = $usuario;
    }
        $usuarios[$key] = $usuario;
      }
  $this->borrar();
  foreach ($usuarios as  $usuario) {
      $jsusuario = json_encode($usuario);
      file_put_contents('usuarios.json',$jsusuario. PHP_EOL,FILE_APPEND);
  }
  }

  public function actualizar(){

  }
  public function borrar(){
    unlink($this->nombreArchivo);
  }
}
