<?php
$ROOT = (!isset($ROOT)) ? "../../" : $ROOT;
require_once($ROOT . "modulos/aplicacion/librerias/Configuracion.cnf.php");
Sesion::init();
$usuario=Sesion::usuario();
$menus = new Aplicacion_Menus();
echo($menus->menu("0003010000",$usuario['usuario']));
?>