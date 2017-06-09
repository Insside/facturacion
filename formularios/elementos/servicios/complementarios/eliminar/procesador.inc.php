<?php
/**
 * Este archivo recibe el nombre del archivo a eliminar y realiza la accion si valoraciones adiciones su
 * proceso implica dos acciones eliminar el registro de la base de datos y eliminar fisicamente el archivo
 * */
$itable=$validaciones->recibir("itable");
$elemento=$validaciones->recibir("elemento");
$fscfe=new Facturacion_Servicios_Complementarios_Facturas_Elementos();

$fscfe->eliminar($elemento); 
$f->windowClose();
$f->JavaScript("if(".$itable."){".$itable.".refresh();}");
?>