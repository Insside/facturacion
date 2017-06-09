<?php
$ROOT = (!isset($ROOT)) ? "../../../" : $ROOT;
require_once($ROOT . "librerias/Configuracion.cnf.php");
// Constantes
if(!defined( __DIR__ ) ){define( __DIR__, dirname(__FILE__) );}
define("_FOMULARIO_","/formulario.inc.php");
define("_PROCESADOR_","/procesador.inc.php");
define("_FACTURACION_FORMULARIOS_",$ROOT."modulos/facturacion/fomularios/");
define("_FACTURACION_LIBRERIAS_",$ROOT."modulos/facturacion/librerias/");
define("_APLICACION_RECONEXION_",$ROOT."modulos/aplicacion/formularios/sesion/reconexion/reconexion.xhr.php");
Sesion::init();
require_once(__DIR__."/Facturacion_Modulo.class.php");
require_once(__DIR__."/Facturacion_Componentes.class.php");
require_once(__DIR__."/Facturacion_Servicios_Complementarios_Facturas.class.php");
require_once(__DIR__."/Facturacion_Servicios_Complementarios_Facturas_Elementos.class.php");
require_once(__DIR__."/Facturacion_Servicios_Complementarios_Facturas_Productos.class.php");
// Otros modulos
require_once($ROOT . "modulos/suscriptores/librerias/Suscriptores.class.php");

?>