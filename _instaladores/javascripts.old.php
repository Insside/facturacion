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

$modulo = new Usuarios_Modulo();
$af = new Aplicacion_Funciones();


/**
 * ************************************************************************************************
  | Creacion y/o sincronización de la función MUI.Usuarios_Perfiles_Consultar();
 * *************************************************************************************************
 * */
$f["funcion"] = "0020040010";
$f["modulo"] = $modulo->modulo;
$f["nombre"] = "Perfiles_Consultar";
$f["parametros"] = "";
$f["descripcion"] = "Este metodo permite desplegar la tabla de perfiles de usuario.";
$f["cuerpo"] = ""
        . "\n var transaccion = (new Date()).valueOf();"
        . "\n var uid=MUI.UID;"
        . "\n MUI.updateContent({"
        . "\n    'element': $('central'),"
        . "\n    'title':'Perfiles de Usuario',"
        . "\n    'data':{'uid':uid,'transaccion':transaccion},"
        . "\n    'loadMethod': 'xhr',"
        . "\n    'url': 'modulos/usuarios/formularios/perfiles/consultar/perfiles.xhr.php',"
        . "\n    'scrollbars':false,"
        . "\n    'headerToolbox': false, "
        . "\n    'padding': {'top': 0, 'right': 0, 'bottom': 0, 'left': 0}"
        . "\n});"
        . "";

$af->sincronizar(["funcion" => $f["funcion"], "modulo" => $f["modulo"], "nombre" => $f["nombre"], "parametros" => $f["parametros"], "cuerpo" => urlencode($f["cuerpo"]), "descripcion" => urlencode($f["descripcion"]), "version" => "0.01", "creacion" => date('Y-m-d', time()), "modificacion" => date('Y-m-d', time()), "estado" => "ACTIVA", "creador" => "0000000000"]);
/* * ************************************************************************************************* */

/**
 * ************************************************************************************************
  | Creacion y/o sincronización de la función MUI.Usuarios_Perfiles_Consultar();
 * *************************************************************************************************
 * */
$f["funcion"] = "0020040020";
$f["modulo"] = $modulo->modulo;
$f["nombre"] = "Perfiles_Perfil_Crear";
$f["parametros"] = "itable";
$f["descripcion"] = "Este metodo permite desplegar la tabla de perfiles de usuario.";
$f["cuerpo"] = ""
        . "var transaccion = (new Date()).valueOf();"
        . "var uid=MUI.UID;"
        . "new MUI.Window({"
        . "\n    'id':'v'+transaccion,"
        . "\n    'title':'Crear Perfil de Usuario',"
        . "\n   'data':{'transaccion':transaccion,'uid':uid,'itable':itable},"
        . "\n   'loadMethod': 'xhr',"
        . "\n   'contentURL': 'modulos/usuarios/formularios/perfil/crear/crear.xhr.php', "
        . "\n   'width': 640, "
        . "\n   'height': 480, "
        . "\n   'scrollbars': false, "
        . "\n   'resizable': false, "
        . "\n   'maximizable': false,"
        . "\n   'padding': {top: 10, right: 10, bottom: 10, left:10}"
        . "\n});"
        . "";

$af->sincronizar(["funcion" => $f["funcion"], "modulo" => $f["modulo"], "nombre" => $f["nombre"], "parametros" => $f["parametros"], "cuerpo" => urlencode($f["cuerpo"]), "descripcion" => urlencode($f["descripcion"]), "version" => "0.01", "creacion" => date('Y-m-d', time()), "modificacion" => date('Y-m-d', time()), "estado" => "ACTIVA", "creador" => "0000000000"]);
/* * ************************************************************************************************* */

/**
 * ************************************************************************************************
  | Creacion y/o sincronización de la función MUI.Usuarios_Perfiles_Consultar();
 * *************************************************************************************************
 * */
$f["funcion"] = "0020010011";
$f["modulo"] = $modulo->modulo;
$f["nombre"] = "Usuario_Estado";
$f["parametros"] = "usuario,itable";
$f["descripcion"] = "Este metodo permite activar o deshabilitar un usuario.";
$f["cuerpo"] = ""
        . "var transaccion = (new Date()).valueOf();"
        . "var uid=MUI.UID;"
        . "new MUI.Window({"
        . "\n    'id':'v'+transaccion,"
        . "\n    'title':'Estado',"
        . "\n   'data':{'transaccion':transaccion,'uid':uid,'usuario':usuario,'itable':itable},"
        . "\n   'loadMethod': 'xhr',"
        . "\n   'contentURL': 'modulos/usuarios/formularios/usuario/estado/estado.xhr.php', "
        . "\n   'width': 480, "
        . "\n   'height': 480, "
        . "\n   'scrollbars': false, "
        . "\n   'resizable': false, "
        . "\n   'maximizable': false,"
        . "\n   'padding': {top: 10, right: 10, bottom: 10, left:10}"
        . "\n});"
        . "";

$af->sincronizar(["funcion" => $f["funcion"], "modulo" => $f["modulo"], "nombre" => $f["nombre"], "parametros" => $f["parametros"], "cuerpo" => urlencode($f["cuerpo"]), "descripcion" => urlencode($f["descripcion"]), "version" => "0.01", "creacion" => date('Y-m-d', time()), "modificacion" => date('Y-m-d', time()), "estado" => "ACTIVA", "creador" => "0000000000"]);
/* * ************************************************************************************************* */

/**
 * ************************************************************************************************
  | Creacion y/o sincronización de la función MUI.Usuarios_Componentes_Busqueda();
 * *************************************************************************************************
 * */
$f["funcion"] = "0020010012";
$f["modulo"] = $modulo->modulo;
$f["nombre"] = "Usuarios_Componente_Busqueda";
$f["parametros"] = "";
$f["descripcion"] = "Este metodo permite activar o deshabilitar un usuario.";
$f["cuerpo"] = ""
        . "\n var transaccion = (new Date()).valueOf();"
        . "\n var uid=MUI.UID;"
        . "\n MUI.updateContent({"
        . "\n    'element': $('complementos'),"
        . "\n    'title':'Busqueda',"
        . "\n    'data':{'uid':uid,'transaccion':transaccion},"
        . "\n    'loadMethod': 'xhr',"
        . "\n    'url': 'modulos/usuarios/formularios/usuarios/consultar/complementos/busqueda/busqueda.xhr.php',"
        . "\n    'scrollbars':false,"
        . "\n    'headerToolbox': false, "
        . "\n    'padding': {'top': 0, 'right': 0, 'bottom': 0, 'left': 0}"
        . "\n});"
        . "";

$af->sincronizar(["funcion" => $f["funcion"], "modulo" => $f["modulo"], "nombre" => $f["nombre"], "parametros" => $f["parametros"], "cuerpo" => urlencode($f["cuerpo"]), "descripcion" => urlencode($f["descripcion"]), "version" => "0.01", "creacion" => date('Y-m-d', time()), "modificacion" => date('Y-m-d', time()), "estado" => "ACTIVA", "creador" => "0000000000"]);
/* * ************************************************************************************************* */

/**
 * ************************************************************************************************
  | Creacion y/o sincronización de la función MUI.Usuarios_Perfiles_Consultar();
 * *************************************************************************************************
 * */
$f["funcion"] = "0020010013";
$f["modulo"] = $modulo->modulo;
$f["nombre"] = "Usuarios_Consultar";
$f["parametros"] = "criterio,valor,inicio,fin";
$f["descripcion"] = "Este metodo consultar el listado de usuarios sugun uno o varios criterios.";
$f["cuerpo"] = ""
        . "\n var transaccion = (new Date()).valueOf();"
        . "\n var uid=MUI.UID;"
        . "\n MUI.updateContent({"
        . "\n    'element': $('central'),"
        . "\n    'title':'Listado de Usuarios Filtrado',"
        . "\n    'data':{'uid':uid,'transaccion':transaccion,'criterio':criterio,'valor':valor,'inicio':inicio,'fin':fin},"
        . "\n    'loadMethod': 'xhr',"
        . "\n    'url': 'modulos/usuarios/formularios/usuarios/consultar/usuarios.xhr.php',"
        . "\n    'scrollbars':false,"
        . "\n    'headerToolbox': false, "
        . "\n    'padding': {'top': 0, 'right': 0, 'bottom': 0, 'left': 0}"
        . "\n});"
        . "";

$af->sincronizar(["funcion" => $f["funcion"], "modulo" => $f["modulo"], "nombre" => $f["nombre"], "parametros" => $f["parametros"], "cuerpo" => urlencode($f["cuerpo"]), "descripcion" => urlencode($f["descripcion"]), "version" => "0.01", "creacion" => date('Y-m-d', time()), "modificacion" => date('Y-m-d', time()), "estado" => "ACTIVA", "creador" => "0000000000"]);
/* * ************************************************************************************************* */

/**
 * ************************************************************************************************
  | Rol Visualizar MUI.Usuarios_Rol_Visualizar();
 * *************************************************************************************************
 * */
$f["funcion"] = "0020020010";
$f["modulo"] = $modulo->modulo;
$f["nombre"] = "Rol_Visualizar";
$f["parametros"] = "rol,itable";
$f["descripcion"] = "Este metodo permite visualizar un rol.";
$f["cuerpo"] = ""
        . "var transaccion = (new Date()).valueOf();"
        . "var uid=MUI.UID;"
        . "new MUI.Window({"
        . "\n    'id':'v'+transaccion,"
        . "\n    'title':'Estado',"
        . "\n   'data':{'transaccion':transaccion,'uid':uid,'rol':rol,'itable':itable},"
        . "\n   'loadMethod': 'xhr',"
        . "\n   'contentURL': 'modulos/usuarios/formularios/rol/visualizar/visualizar.xhr.php', "
        . "\n   'width': 640, "
        . "\n   'height': 280, "
        . "\n   'scrollbars': false, "
        . "\n   'resizable': false, "
        . "\n   'maximizable': false,"
        . "\n   'padding': {top: 10, right: 10, bottom: 10, left:10}"
        . "\n});"
        . "";

$af->sincronizar(["funcion" => $f["funcion"], "modulo" => $f["modulo"], "nombre" => $f["nombre"], "parametros" => $f["parametros"], "cuerpo" => urlencode($f["cuerpo"]), "descripcion" => urlencode($f["descripcion"]), "version" => "0.01", "creacion" => date('Y-m-d', time()), "modificacion" => date('Y-m-d', time()), "estado" => "ACTIVA", "creador" => "0000000000"]);
/* * ************************************************************************************************* */

/**
 * ************************************************************************************************
  | Rol Visualizar MUI.Usuarios_Rol_Modificar();
 * *************************************************************************************************
 * */
$f["funcion"] = "0020020020";
$f["modulo"] = $modulo->modulo;
$f["nombre"] = "Rol_Modificar";
$f["parametros"] = "rol,itable";
$f["descripcion"] = "Este metodo permite modificar un rol.";
$f["cuerpo"] = ""
        . "var transaccion = (new Date()).valueOf();"
        . "var uid=MUI.UID;"
        . "new MUI.Window({"
        . "\n    'id':'v'+transaccion,"
        . "\n    'title':'Estado',"
        . "\n   'data':{'transaccion':transaccion,'uid':uid,'rol':rol,'itable':itable},"
        . "\n   'loadMethod': 'xhr',"
        . "\n   'contentURL': 'modulos/usuarios/formularios/rol/modificar/modificar.xhr.php', "
        . "\n   'width': 640, "
        . "\n   'height': 480, "
        . "\n   'scrollbars': false, "
        . "\n   'resizable': false, "
        . "\n   'maximizable': false,"
        . "\n   'padding': {top: 10, right: 10, bottom: 10, left:10}"
        . "\n});"
        . "";

$af->sincronizar(["funcion" => $f["funcion"], "modulo" => $f["modulo"], "nombre" => $f["nombre"], "parametros" => $f["parametros"], "cuerpo" => urlencode($f["cuerpo"]), "descripcion" => urlencode($f["descripcion"]), "version" => "0.01", "creacion" => date('Y-m-d', time()), "modificacion" => date('Y-m-d', time()), "estado" => "ACTIVA", "creador" => "0000000000"]);
/* * ************************************************************************************************* */



/**
 * ************************************************************************************************
  | Rol Visualizar MUI.Usuarios_Rol_Permisos_Modificar();
 * *************************************************************************************************
 * */
$f["funcion"] = "0020020021";
$f["modulo"] = $modulo->modulo;
$f["nombre"] = "Rol_Politicas_Modificar";
$f["parametros"] = "rol,itable";
$f["descripcion"] = "Este metodo permite modificar un rol.";
$f["cuerpo"] = ""
        . "var transaccion = (new Date()).valueOf();"
        . "var uid=MUI.UID;"
        . "new MUI.Window({"
        . "\n    'id':'v'+transaccion,"
        . "\n    'title':'Modificar Politicas',"
        . "\n   'data':{'transaccion':transaccion,'uid':uid,'rol':rol,'itable':itable},"
        . "\n   'loadMethod': 'xhr',"
        . "\n   'contentURL': 'modulos/usuarios/formularios/rol/politicas/politicas.xhr.php', "
        . "\n   'width': 640, "
        . "\n   'height': 370, "
        . "\n   'scrollbars': false, "
        . "\n   'resizable': false, "
        . "\n   'maximizable': false,"
        . "\n   'padding': {top: 10, right: 10, bottom: 10, left:10}"
        . "\n});"
        . "";

$af->sincronizar(["funcion" => $f["funcion"], "modulo" => $f["modulo"], "nombre" => $f["nombre"], "parametros" => $f["parametros"], "cuerpo" => urlencode($f["cuerpo"]), "descripcion" => urlencode($f["descripcion"]), "version" => "0.01", "creacion" => date('Y-m-d', time()), "modificacion" => date('Y-m-d', time()), "estado" => "ACTIVA", "creador" => "0000000000"]);
/* * ************************************************************************************************* */

/**
 * ************************************************************************************************
  | Acceder al Modulo  MUI.Usuarios_Modulo();
 * *************************************************************************************************
 * */
$f["funcion"] = "1364210758";
$f["modulo"] = $modulo->modulo;
$f["nombre"] = "Modulo";
$f["parametros"] = "";
$f["descripcion"] = "Este metodo permite modificar un rol.";
$f["cuerpo"] = ""
        . "MUI.Usuarios_Inicial();"
        . "MUI.Usuarios_Componentes();"
        . "MUI.Usuarios_Complementos_Inicial();"
        . "";

$af->sincronizar(["funcion" => $f["funcion"], "modulo" => $f["modulo"], "nombre" => $f["nombre"], "parametros" => $f["parametros"], "cuerpo" => urlencode($f["cuerpo"]), "descripcion" => urlencode($f["descripcion"]), "version" => "0.01", "creacion" => date('Y-m-d', time()), "modificacion" => date('Y-m-d', time()), "estado" => "ACTIVA", "creador" => "0000000000"]);
/* * ************************************************************************************************* */

/**
 * ************************************************************************************************
  | Acceder al Modulo  MUI.Usuarios_Modulo();
 * *************************************************************************************************
 * */
$f["funcion"] = "1364211063";
$f["modulo"] = $modulo->modulo;
$f["nombre"] = "Componentes";
$f["parametros"] = "";
$f["descripcion"] = "Este metodo permite modificar un rol.";
$f["cuerpo"] = ""
        . "\n var transaccion = (new Date()).valueOf();"
        . "\n var uid=MUI.UID;"
        . "\n MUI.updateContent({"
        . "\n    'element': $('componentes'),"
        . "\n    'title':'Componentes',"
        . "\n    'data':{'uid':uid,'transaccion':transaccion},"
        . "\n    'loadMethod': 'xhr',"
        . "\n    'url': 'modulos/usuarios/componentes.xhr.php',"
        . "\n    'scrollbars':false,"
        . "\n    'headerToolbox': true, "
        . "\n    'padding': {'top': 0, 'right': 0, 'bottom': 0, 'left': 0}"
        . "\n});"
        . "";

$af->sincronizar(["funcion" => $f["funcion"], "modulo" => $f["modulo"], "nombre" => $f["nombre"], "parametros" => $f["parametros"], "cuerpo" => urlencode($f["cuerpo"]), "descripcion" => urlencode($f["descripcion"]), "version" => "0.01", "creacion" => date('Y-m-d', time()), "modificacion" => date('Y-m-d', time()), "estado" => "ACTIVA", "creador" => "0000000000"]);
/* * ************************************************************************************************* */

/**
 * ************************************************************************************************
  | Usuario: MUI.Usuarios_Usuario_Consultar(usuario);
 * *************************************************************************************************
 * */
$f["funcion"] = "1396435022";
$f["modulo"] = $modulo->modulo;
$f["nombre"] = "Usuario_Consultar";
$f["parametros"] = "usuario,itable";
$f["descripcion"] = "Visualiza la información corresondiente a un usuario.";
$f["cuerpo"] = ""
        . "\n var transaccion = (new Date()).valueOf();"
        . "\n var uid=MUI.UID;"
        . "\n new MUI.Window({"
        . "\n   'id':'v'+transaccion,"
        . "\n   'title':'Usuario',"
        . "\n   'data':{'transaccion':transaccion,'uid':uid,'usuario':usuario,'itable':itable},"
        . "\n   'loadMethod': 'xhr',"
        . "\n   'contentURL': 'modulos/usuarios/formularios/usuario/visualizar/visualizar.xhr.php', "
        . "\n   'width': 640, "
        . "\n   'height': 480, "
        . "\n   'scrollbars': false, "
        . "\n   'resizable': false, "
        . "\n   'maximizable': false,"
        . "\n   'padding': {top: 10, right: 10, bottom: 10, left:10}"
        . "\n });"
        . "";

$af->sincronizar(["funcion" => $f["funcion"], "modulo" => $f["modulo"], "nombre" => $f["nombre"], "parametros" => $f["parametros"], "cuerpo" => urlencode($f["cuerpo"]), "descripcion" => urlencode($f["descripcion"]), "version" => "0.01", "creacion" => date('Y-m-d', time()), "modificacion" => date('Y-m-d', time()), "estado" => "ACTIVA", "creador" => "0000000000"]);
/* * ************************************************************************************************* */

/**
 * ************************************************************************************************
  | Usuario: MUI.Usuarios_Usuario_Consultar(usuario);
 * *************************************************************************************************
 * */
$f["funcion"] = "1396435023";
$f["modulo"] = $modulo->modulo;
$f["nombre"] = "Perfiles_Perfil_Modificar";
$f["parametros"] = "usuario,itable";
$f["descripcion"] = "Modifica un perfil de usuario.";
$f["cuerpo"] = ""
        . "\n var transaccion = (new Date()).valueOf();"
        . "\n var uid=MUI.UID;"
        . "\n new MUI.Window({"
        . "\n   'id':'v'+transaccion,"
        . "\n   'title':'Usuario',"
        . "\n   'data':{'transaccion':transaccion,'uid':uid,'usuario':usuario,'itable':itable},"
        . "\n   'loadMethod': 'xhr',"
        . "\n   'contentURL': 'modulos/usuarios/formularios/perfil/modificar/modificar.xhr.php', "
        . "\n   'width': 640, "
        . "\n   'height': 480, "
        . "\n   'scrollbars': false, "
        . "\n   'resizable': false, "
        . "\n   'maximizable': false,"
        . "\n   'padding': {top: 10, right: 10, bottom: 10, left:10}"
        . "\n });"
        . "";

$af->sincronizar(["funcion" => $f["funcion"], "modulo" => $f["modulo"], "nombre" => $f["nombre"], "parametros" => $f["parametros"], "cuerpo" => urlencode($f["cuerpo"]), "descripcion" => urlencode($f["descripcion"]), "version" => "0.01", "creacion" => date('Y-m-d', time()), "modificacion" => date('Y-m-d', time()), "estado" => "ACTIVA", "creador" => "0000000000"]);
echo("<br>" . $f["funcion"] . " " . $f["nombre"] );
/* * ************************************************************************************************* */



/**
 * ************************************************************************************************
  | Usuario: MUI.Usuarios_Usuario_Consultar(usuario);
 * *************************************************************************************************
 * */
$f["funcion"] = "1428595887";
$f["modulo"] = $modulo->modulo;
$f["nombre"] = "Perfiles_Perfil_Modificar";
$f["parametros"] = "usuario,itable";
$f["descripcion"] = "Modifica un perfil de usuario.";
$f["cuerpo"] = ""
        . "\n var transaccion = (new Date()).valueOf();"
        . "\n var uid=MUI.UID;"
        . "\n new MUI.Window({"
        . "\n   'id':'v'+transaccion,"
        . "\n   'title':'Usuario',"
        . "\n   'data':{'transaccion':transaccion,'uid':uid,'usuario':usuario,'itable':itable},"
        . "\n   'loadMethod': 'xhr',"
        . "\n   'contentURL': 'modulos/usuarios/formularios/perfil/personal/personal.xhr.php', "
        . "\n   'width': 640, "
        . "\n   'height': 480, "
        . "\n   'scrollbars': false, "
        . "\n   'resizable': false, "
        . "\n   'maximizable': false,"
        . "\n   'padding': {top: 10, right: 10, bottom: 10, left:10}"
        . "\n });"
        . "";

$af->sincronizar(["funcion" => $f["funcion"], "modulo" => $f["modulo"], "nombre" => $f["nombre"], "parametros" => $f["parametros"], "cuerpo" => urlencode($f["cuerpo"]), "descripcion" => urlencode($f["descripcion"]), "version" => "0.01", "creacion" => date('Y-m-d', time()), "modificacion" => date('Y-m-d', time()), "estado" => "ACTIVA", "creador" => "0000000000"]);
echo("<br>" . $f["funcion"] . " " . $f["nombre"] );
/* * ************************************************************************************************* */
?>