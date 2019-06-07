<?php
class Query{
  static public function mostrarUsuario($pdo, $tabla, $id_usuario){ //metodos estaticos
    $sql = "select * from $tabla where $tabla.id ='$id_usuario'";
    $query=$pdo->prepare($sql);
    $query->execute();
    $usuarioEncontrado=$query->fetchAll(PDO::FETCH_ASSOC);
    return $usuarioEncontrado;
  }
  static public function borrarUsuario($pdo, $tabla, $id_usuario){
    $sql= "delete from $tabla where $tabla.id= :id";
    $query=$pdo->prepare($sql);
    $query->bindValue(':id', $id_usuario);
    $query->execute();
  }
  static public function usuarioModificar($pdo, $tabla, $id_usuario){
      $sql = "select * from $tabla where $tabla.id ='$id_usuario'";
      $query=$pdo->prepare($sql);
      $query->execute();
      $usuarioModificar= $query->fetch(PDO::FETCH_ASSOC);
      return $usuarioModificar;
      }
    }



 ?>
