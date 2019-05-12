<?php
/**
 *
 */
abstract class BaseDatos{
  abstract public function guardar(array $registro);//tengo que decirle lo que va a llegar
  abstract public function abrirBaseDatos();
  abstract public function borrar();
  abstract public function actualizar();
}
