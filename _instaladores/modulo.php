<?php
/** Librerias **/
require($ROOT."modulos/aplicacion/librerias/Aplicacion_Modulos.class.php");
/** Variables **/
$fechas=new Fechas();
$am=new Aplicacion_Modulos();
/** Estamentos **/
$modulo["modulo"]="301";
$modulo["nombre"]="Facturacion";
$modulo["titulo"]="Modulo de Facturación.";
$modulo["descripcion"]="Modulo para administrar la facturación de servicios complementarios.";
$modulo["fecha"]=$fechas->hoy();
$modulo["hora"]=$fechas->ahora();
$modulo["creador"]="0";
/** 
 * Se verifica la existencia del módulo si este existe, se verifica si la referencia 
 * del mismo coincide y su versión. 
 */
$datos=$am->consultar($modulo["modulo"]);
if(isset($datos["modulo"])){
    $html.=("<li>El módulo existia previamente.</li>");
}else{
    $am->crear($modulo);
    $html.=("<li>El módulo se ha registrado satisfactoriamente.</li>");
}
?>