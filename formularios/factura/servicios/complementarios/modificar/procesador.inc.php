<?php
$cadenas = new Cadenas();
$fechas = new Fechas();
$usuarios=new Usuarios();
/* 
 * Copyright (c) 2014, Alexis
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

/** Celdas **/
$usuario=  Sesion::usuario();
$itabla=$validaciones->recibir("itable");
$clase=new Facturacion_Servicios_Complementarios_Facturas();
print_r($_REQUEST);
/** Campos Recibidos **/
$datos=array();
$datos['factura']=$validaciones->recibir("factura");
$datos['suscriptor']=$validaciones->recibir("suscriptor");
$datos['fecha']=$fechas->hoy();
$datos['emision']=$validaciones->recibir("fecha");
$datos['hora']=$validaciones->recibir("hora");
$datos['pago']=$validaciones->recibir("pago");
$datos['vencimiento']=$validaciones->recibir("vencimiento");
$datos['observacion']=urlencode($validaciones->recibir("observacion"));
$datos['creador']=$usuario["usuario"];
$datos['relacion']=$validaciones->recibir("relacion");
$datos['documento']=$validaciones->recibir("documento");
$datos['identificacion']=$validaciones->recibir("identificacion");
$datos['nombre']=$validaciones->recibir("nombre");
$datos['direccion']=$validaciones->recibir("direccion");
$datos['telefono']=$validaciones->recibir("telefono");
$datos['ciudad']=$validaciones->recibir("ciudad");
$datos['cuotas']=$validaciones->recibir("cuotas");

foreach ($datos as $campo => $valor) {
  $clase->actualizar($datos['factura'],$campo, $valor);
}
/** JavaScripts **/
$f->JavaScript($itabla.".refresh();");
$f->JavaScript("MUI.closeWindow($('".($f->ventana)."'));");
/** - - - - **/
?>