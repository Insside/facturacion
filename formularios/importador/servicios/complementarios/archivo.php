<?php

if (!defined(__DIR__)) {
    define(__DIR__, dirname(__FILE__));
}
$ROOT = (!isset($ROOT)) ? "../../../../../../" : $ROOT;
require_once($ROOT . "modulos/facturacion/librerias/Configuracion.cnf.php");

Sesion::init();

$html = "";
$html.="";
$html.="";
$html.="";
//datos del arhivo
$fid=$_REQUEST["fid"];
$nombre = $_FILES['archivo'.$fid]['name'];
$tipo = $_FILES['archivo'.$fid]['type'];
$tamano = $_FILES['archivo'.$fid]['size'];
//compruebo si las características del archivo son las que deseo
if (!(strpos($nombre, "xls"))) {
    $html.="Incorrecto";
} else {
    $nombre=time() . $nombre;
    if (move_uploaded_file($_FILES['archivo'.$fid]['tmp_name'], $nombre)) {
            $html.=$nombre;
            //$html.="";
            //$directorio = array_diff(scandir(__DIR__), array('..', '.'));
            //$html.=("");
            //for ($f = 0; $f < count($directorio); $f++) {
            //    if (strpos($directorio[$f], "xls")) {
            //        $html.=$directorio[$f];
            //    }
            //}
            //$html.=("");
    } else {
        $html.="";
    }
}
$html.="";
$html.="";
echo($html);
?>