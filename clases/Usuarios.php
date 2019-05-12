<?php
/**
 *
 */
 class Usuario {
   private $email;
   private $password;
   private $repassword;
   private $nombreUsuario;
   private $pais;
   private $foto;
   public function __construct($email,$password,$repassword=null,$nombreUsuario=null,$pais=null,$foto=null)
   {
     $this->email=$email;
     $this->password=$password;
     $this->repassword=$repassword;
     $this->nombreUsuario=$nombreUsuario;
     $this->pais=$pais;
     $this->foto=$foto;
   }
   public function getNombreUsuario(){
     return $this->nombreUsuario;
   }
   public function setNombreUsuario($nombreUsuario){
     $this->nombreUsuario=$nombreUsuario;
   }
   public function getEmail(){
     return $this->email;
   }
   public function setEmail($email){
     $this->email=$email;
   }
   public function getPass(){
     return $this->password;
   }
   public function setPass($password){
     $this->password=$password;
   }
   public function getRePass(){
     return $this->repassword;
   }
   public function setRePass($repassword){
     $this->repassword=$repassword;
   }
   public function getPais(){
     return $this->pais;
   }
   public function setPais($pais){
     $this->pais=$pais;
   }
   public function getFoto(){
     return $this->foto;
   }
   public function setFoto($foto){
     $this->foto=$foto;
   }
 }
