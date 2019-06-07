<?php

class BaseMysql extends BaseDatos{
  static public function conexion($host,$bd, $usuario, $password,$puerto,$charset){
    try {
      $dsn="mysql:host=".$host.";"."dbname=".$bd . ";". "port=". $puerto . ";"."charset=".$charset;
      $baseDatos = new PDO($dsn, $usuario, $password);
      $baseDatos->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      return $baseDatos;
    } catch (PDOException $e) {
      echo "No se pudo conectarse a la Base de datos" . $e->getMessage();
      exit;
    }
  }
  static public function guardarUsuario($pdo, $user, $tabla){
    $sql ="insert into $tabla(name, email, password, avatar, country_id) values(:name, :email, :password, :avatar, :pais)";
    $query =$pdo->prepare($sql);
    $query->bindValue(':name', $user->getNombreUsuario());
    $query->bindValue(':email',$user->getEmail());
    $query->bindValue(':password', Encriptar::hashPassword($user->getPass()));
    $query->bindValue(':avatar',$user->getFoto());
    $query->bindValue(':pais', $user->getPais());
    $query->execute();
  }

   public static function checkearPorEmail($email, $pdo, $tabla){
    $sql= "select * from $tabla where email =:email";
    $query =$pdo->prepare($sql);
    $query->bindValue(':email', $email);
    $query->execute();
    $usuario = $query->fetch(PDO::FETCH_ASSOC);
    return $usuario;
  }

   public static function checkearUsuario($nombreUsuario, $pdo, $tabla){
    $sql= "select * from $tabla where name = :nombreUsuario";
    $query=$pdo->prepare($sql);
    $query->bindValue(':nombreUsuario', $nombreUsuario);
    $query->execute();
    $usuario= $query->fetch(PDO::FETCH_ASSOC);
    return $usuario;
  }
   public static function paises($pdo){
    $sql = "select id,nombre from countries";
    $query=$pdo->prepare($sql);
    $query->execute();
    $paisElegido=$query->fetchAll(PDO::FETCH_ASSOC);
    return $paisElegido;
  }

  public function abrirBaseDatos(){
  }
  public function actualizar(){
  }
  public function borrar(){
  }
  public function guardar($usuario){

  }


}





 ?>
