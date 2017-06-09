<?php

$ROOT = (!isset($ROOT)) ? "../../../../../" : $ROOT;
require_once($ROOT . "modulos/facturacion/librerias/Configuracion.cnf.php");

$importacion="1477323602";

// Eliminar todas las facturas importadas 
$db = new MySQL(Sesion::getConexion());
$sql = ""
        . "DELETE FROM `insside`.`facturacion_servicios_complementarios_facturas` "
        . "WHERE `importado`='".$importacion."';";
$db->sql_query($sql);
$db->sql_close();

// Eliminar todas las facturas importadas 
$db = new MySQL(Sesion::getConexion());
$sql = ""
        . "DELETE FROM `insside`.`facturacion_servicios_complementarios_facturas_elementos` "
        . "WHERE `importado`='".$importacion."';";
$db->sql_query($sql);
$db->sql_close();

?>