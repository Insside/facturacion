<?php
/** Variables **/
$sesion=new Sesion();
$cadenas = new Cadenas();
$fechas = new Fechas();
$validaciones = new Validaciones();
$perfils=new Usuarios_Perfiles();
$equipos=new Usuarios_Equipos();
$fscf=new Facturacion_Servicios_Complementarios_Facturas();
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

/** Variables **/
$cadenas = new Cadenas();
$fechas = new Fechas();
$validaciones = new Validaciones();
$fscf=new Facturacion_Servicios_Complementarios_Facturas();
/** Valores **/
$itable=$validaciones->recibir("itable");
$valores['factura']=$validaciones->recibir("factura");
$valores=$fscf->consultar($valores['factura']);
/** Campos **/
if(!empty($itable)){$f->oculto("itable",$itable);}
$f->campos['factura']=$f->dynamic(array("field"=>"factura","class"=>"codigo","readonly"=>"true","value"=>$valores['factura']));
$f->campos['suscriptor']=$f->dynamic(array("field"=>"suscriptor","value"=>$valores['suscriptor']));
$f->campos['fecha']=$f->dynamic(array("field"=>"fecha","value"=>$valores['emision']));
$f->campos['hora']=$f->dynamic(array("field"=>"hora","value"=>$valores['hora']));
$f->campos['pago']=$f->dynamic(array("field"=>"pago","value"=>$valores['pago']));
$f->campos['vencimiento']=$f->dynamic(array("field"=>"vencimiento","value"=>$valores['vencimiento']));
$f->campos['observacion']=$f->dynamic(array("field"=>"observacion","value"=>urldecode($valores['observacion'])));
$f->campos['creador']=$f->dynamic(array("field"=>"creador","value"=>$valores['creador']));
$f->campos['relacion']=$f->dynamic(array("field"=>"relacion","value"=>$valores['relacion']));
$f->campos['documento']=$f->dynamic(array("field"=>"documento","value"=>$valores['documento']));
$f->campos['identificacion']=$f->dynamic(array("field"=>"identificacion","value"=>$valores['identificacion']));
$f->campos['nombre']=$f->dynamic(array("field"=>"nombre","value"=>$valores['nombre']));
$f->campos['direccion']=$f->dynamic(array("field"=>"direccion","value"=>$valores['direccion']));
$f->campos['telefono']=$f->dynamic(array("field"=>"telefono","value"=>$valores['telefono']));
$f->campos['ciudad']=$f->dynamic(array("field"=>"ciudad","value"=>$valores['ciudad']));
$f->campos['cuotas']=$f->dynamic(array("field"=>"cuotas","value"=>$valores['cuotas']));
$f->campos['ayuda']=$f->button("ayuda".$f->id, "button","Ayuda");
$f->campos['cancelar']=$f->button("cancelar".$f->id, "button","Cancelar");
$f->campos['continuar']=$f->button("continuar".$f->id, "submit","Continuar");
/** Celdas **/
$f->celdas["factura"]=$f->celda("Factura:",$f->campos['factura'], "", "w100px");
$f->celdas["suscriptor"]=$f->celda("Suscriptor:",$f->campos['suscriptor'], "", "w100px");
$f->celdas["fecha"]=$f->celda("Fecha Emisión:",$f->campos['fecha'], "", "w100px");
$f->celdas["hora"]=$f->celda("Hora:",$f->campos['hora'],"","w080px");
$f->celdas["pago"]=$f->celda("Pago:",$f->campos['pago'],"","w100px");
$f->celdas["vencimiento"]=$f->celda("Vencimiento:",$f->campos['vencimiento'], "", "w100px");
$f->celdas["observacion"]=$f->celda("Observacion:",$f->campos['observacion']);
$f->celdas["creador"]=$f->celda("Creador:",$f->campos['creador']);
$f->celdas["relacion"]=$f->celda("Relación Referencia:",$f->campos['relacion'],"","w120px");
$f->celdas["documento"]=$f->celda("Documento:",$f->campos['documento'],"","w100px");
$f->celdas["identificacion"]=$f->celda("Identificación:",$f->campos['identificacion'],"","w100px");
$f->celdas["nombre"]=$f->celda("Nombre:",$f->campos['nombre']);
$f->celdas["direccion"]=$f->celda("Dirección:",$f->campos['direccion']);
$f->celdas["telefono"]=$f->celda("Telefono:",$f->campos['telefono']);
$f->celdas["ciudad"]=$f->celda("Ciudad:",$f->campos['ciudad']);
$f->celdas["cuotas"]=$f->celda("Cuotas:",$f->campos['cuotas']);
/** Filas **/
$f->fila["fila1"]=$f->fila($f->celdas["factura"].$f->celdas["suscriptor"].$f->celdas["fecha"].$f->celdas["hora"].$f->celdas["vencimiento"]);
$f->fila["fila2"]=$f->fila($f->celdas["relacion"].$f->celdas["documento"].$f->celdas["identificacion"].$f->celdas["nombre"]);
$f->fila["fila3"]=$f->fila($f->celdas["direccion"].$f->celdas["telefono"].$f->celdas["ciudad"].$f->celdas["cuotas"].$f->celdas["pago"]);
$f->fila["fila4"]=$f->fila($f->celdas["observacion"]);
/** Compilando **/
$f->filas($f->fila['fila1']);
$f->filas($f->fila['fila2']);
$f->filas($f->fila['fila3']);
$f->filas($f->fila['fila4']);
/** Botones **/
$f->botones($f->campos['ayuda'], "inferior-izquierda");
$f->botones($f->campos['cancelar'], "inferior-derecha");
$f->botones($f->campos['continuar'], "inferior-derecha");
/** Javascripts **/
$f->JavaScript("MUI.titleWindow($('" . ($f->ventana) . "'), \"Modificar Factura v1.1\");");
$f->JavaScript("MUI.resizeWindow($('" . ($f->ventana) . "'), {width: 750, height:530});");
$f->JavaScript("MUI.centerWindow($('" . $f->ventana . "'));");
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('".$f->ventana."'));");
?>