<?php
require_once("helpers.php");
require_once("clases/Usuarios.php");
require_once("clases/Validador.php");
require_once("clases/BaseDatos.php");
require_once("clases/BaseJson.php");
require_once("clases/Encriptar.php");
require_once("clases/ArmarRegistro.php");
require_once("clases/Logeo.php");
require_once("clases/BaseMysql.php");


$host = "localhost";
$bd = "flopatin";
$usuario = "root";
$password= "";
$puerto = "3306";
$charset = "utf8mb4";


$pdo = BaseMysql::conexion($host,$bd, $usuario, $password,$puerto,$charset);


$validar=new Validador();
$json=new BaseJson("usuarios.json");
$registro=new armarRegistro();
Logeo::iniciarSession();
