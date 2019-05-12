<?php
/**
 *
 */
 class armarRegistro{
   public function armarUsuario($registro,$foto){
     setlocale(LC_TIME,"es_ES");
     $fecharegistro=strftime("%e de ",time()).ucfirst(strftime("%B de %Y",time()));
     $usuario = [
         // "nombre"=>$registro->getNombre(),
         // "apellido"=>$registro->getApellido(),
         "nombreUsuario"=>$registro->getNombreUsuario(),
         "email"=>$registro->getEmail(),
         "password"=> Encriptar::hashPassword($registro->getPass()),
         "foto"=>$foto,
         "pais"=>$registro->getPais(),
         "fecharegistro"=>$fecharegistro,
         "perfil"=>1
     ];
     return $usuario;
   }
   public function armarFoto($foto){
     $ext=pathinfo($foto["foto"]["name"], PATHINFO_EXTENSION);
     $archivoOrigen= $foto["foto"]["tmp_name"];
     $imagen=uniqid(). "." . $ext;
     $archivoDestino= dirname(__DIR__)."/imagenes/". $imagen;
     move_uploaded_file($archivoOrigen, $archivoDestino);
     return $imagen;
   }
 }
