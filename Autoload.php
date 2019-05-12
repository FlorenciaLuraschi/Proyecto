<?php
require_once("helpers.php");
require_once("clases/Usuarios.php");
require_once("clases/Validador.php");
require_once("clases/BaseDatos.php");
require_once("clases/BaseJson.php");
require_once("clases/Encriptar.php");
require_once("clases/ArmarRegistro.php");
require_once("clases/Logeo.php");
$validar=new Validador();
$json=new BaseJson("usuarios.json");
$registro=new armarRegistro();
Logeo::iniciarSession();
