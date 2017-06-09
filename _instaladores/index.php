<?php
$ROOT = (!isset($ROOT)) ? "../../../" : $ROOT;
require_once($ROOT . "librerias/Configuracion.cnf.php");
require_once($ROOT . "modulos/facturacion/librerias/Configuracion.cnf.php");

/* 
 * Al ejecutar este archivo se realizara la instalación del modulo en la
 * Plataforma Insside. Este archivo registrara el modulo, creara las tablas,
 * creara el codigo JavaScript necesario para la interface, y registrara los componentes
 * con sus respectivos menus.
 */

$html="<html>";
$html.="<head>";
$html.="<link href=\"estilos.css\" rel=\"stylesheet\" type=\"text/css\">";
$html.="</head>";
$html.="<body>";
$html.="<ol>";
require_once("modulo.php");
//require_once("estructuras.php");
require_once("javascripts.php");
//require_once("componentes.php");
//require_once("permisos.php");
$html.="</ol>";
$html.="</body>";
$html.="</html";
echo($html);
?>