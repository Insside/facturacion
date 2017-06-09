<?php

$ROOT = (!isset($ROOT)) ? "../../../" : $ROOT;
require_once($ROOT . "modulos/usuarios/librerias/Configuracion.cnf.php");
require_once($ROOT . "modulos/aplicacion/librerias/Aplicacion_Funciones.class.php");
require_once($ROOT . "modulos/usuarios/librerias/Usuarios_Modulo.class.php");
/*
 * @package Insside\Modulos\Usuarios
 * @author Jose Alexis Correa Valencia <jalexiscv@gmail.com>
 * @copyright (c) 2015 www.insside.com
 * 
 * All rights reserved. 
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * * Redistributions of source code must retain the above copyright notice, this
 *   list of conditions and the following disclaimer.
 * * Redistributions in binary form must reproduce the above copyright notice,
 *   this list of conditions and the following disclaimer in the documentation
 *   and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */
$af = new Aplicacion_Funciones();
$html.="<li>Sincronizando Funciones";
$html.="    <ol>";
/**
 * ************************************************************************************************
  | Creacion y/o sincronización de la función MUI.Usuarios_Perfiles_Consultar();
 * *************************************************************************************************
 * */
$modulo["componente"]="009";//Procedimientos de exportación e importación.
$f["funcion"] = "1".$modulo["modulo"].$modulo["componente"]."001";
$f["modulo"] = $modulo["modulo"];
$f["nombre"] = "Servicios_Complementarios_Facturacion_Importar";
$f["parametros"] = "";
$f["descripcion"] = "Inicio del módulo de formularios.";
$f["cuerpo"] = ""
        . "\n var transaccion = (new Date()).valueOf();"
        . "\n var uid=MUI.UID;"
        . "\n new MUI.Window({"
        . "\n   'id':'v'+transaccion,"
        . "\n   'title':'Facturación / Servicios Complementarios / Importar / v.3',"
        . "\n   'data':{'transaccion':transaccion,'uid':uid,'itable':itable},"
        . "\n   'loadMethod': 'xhr',"
        . "\n   'contentURL': 'modulos/facturacion/formularios/importador/servicios/complementarios/importador.xhr.php', "
        . "\n   'width': 640, "
        . "\n   'height': 480, "
        . "\n   'scrollbars': false, "
        . "\n   'resizable': false, "
        . "\n   'maximizable': false,"
        . "\n   'padding': {top: 10, right: 10, bottom: 10, left:10}"
        . "\n});"
        . "";

$af->sincronizar(array(
    "funcion" => $f["funcion"], 
    "modulo" => $f["modulo"], 
    "nombre" => $f["nombre"], 
    "parametros" => $f["parametros"], 
    "cuerpo" => urlencode($f["cuerpo"]), 
    "descripcion" => urlencode($f["descripcion"]), 
    "version" => "0.01", 
    "creacion" => date('Y-m-d', time()), 
    "modificacion" => date('Y-m-d', time()), 
    "estado" => "ACTIVA", 
    "creador" => "0000000000")
);
$html.=("<li><b>" . $f["funcion"] . "</b> MUI.". $modulo["nombre"]."_". $f["nombre"] ."</li>");
/* * ************************************************************************************************* */

$html.="    </ol>";
?>