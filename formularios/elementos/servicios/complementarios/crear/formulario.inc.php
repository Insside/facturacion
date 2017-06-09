<?php
/** Variables **/
$sesion=new Sesion();
$cadenas = new Cadenas();
$fechas = new Fechas();
$validaciones = new Validaciones();
$perfils=new Usuarios_Perfiles();
$equipos=new Usuarios_Equipos();
$fscfp=new Facturacion_Servicios_Complementarios_Facturas_Productos();
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
/** Valores **/
$itable=$validaciones->recibir("itable");
$valores['elemento']=$validaciones->recibir("_elemento");
$valores['factura']=$validaciones->recibir("factura");
$valores['producto']=$validaciones->recibir("_producto");
$valores['unitario']=$validaciones->recibir("unitario");
$valores['cantidad']=$validaciones->recibir("_cantidad");
$valores['iva']=$validaciones->recibir("_iva");
$valores['fecha']=$fechas->hoy();
$valores['hora']=$fechas->ahora();
/** Campos **/
if(!empty($itable)){$f->oculto("itable",$itable);}
$f->oculto("elemento",time());
$f->oculto("factura",$valores['factura']);
$f->oculto("fecha",$valores['fecha']);
$f->oculto("hora",$valores['hora']);
$f->campos['producto']=$fscfp->combo("producto","");
$f->campos['cantidad']=$f->dynamic(array("field"=>"cantidad","value"=>"1"));
$f->campos['unitario']=$f->dynamic(array("field"=>"unitario"));
$f->campos['iva']=$f->dynamic(array("field"=>"iva","value"=>"0.16"));
$f->campos['subtotal']=$f->iTextBox("subtotal","entero", "0");
$f->campos['ayuda']=$f->button("ayuda".$f->id, "button","Ayuda");
$f->campos['cancelar']=$f->button("cancelar".$f->id, "button","Cancelar");
$f->campos['continuar']=$f->button("continuar".$f->id, "submit","Continuar");
/** Celdas **/
$f->celdas["producto"]=$f->celda("Producto:",$f->campos['producto']);
$f->celdas["cantidad"]=$f->celda("Cantidad:",$f->campos['cantidad']);
$f->celdas["unitario"]=$f->celda("V/Unitario:",$f->campos['unitario']);
$f->celdas["iva"]=$f->celda("Iva:",$f->campos['iva']);
$f->celdas["subtotal"]=$f->celda("Subtotal:",$f->campos['subtotal']);
/** Filas **/
$f->fila["fila1"]=$f->fila(
        $f->celdas["producto"].
        $f->celdas["cantidad"].
        $f->celdas["unitario"].
        $f->celdas["iva"].
        $f->celdas["subtotal"]
);
/** Compilando **/
$f->filas($f->fila['fila1']);
/** Botones **/
$f->botones($f->campos['ayuda'], "inferior-izquierda");
$f->botones($f->campos['cancelar'], "inferior-derecha");
$f->botones($f->campos['continuar'], "inferior-derecha");
/** JavaScripts **/
$f->JavaScript(""
        . "function calculo_unitario".$f->id."(){"
        . "   var cantidad=\$(\"cantidad\").value;"
        . "   var unitario=\$(\"unitario\").value;"
        . "   var iva=\$(\"iva\").value;"
        . "   if(cantidad>0&&iva>=0){"
        . "      var neto=parseFloat(unitario)*parseFloat(cantidad);"
        . "      var subtotal=neto+(neto*parseFloat(iva));"
        . "      \$(\"subtotal\").value=Math.round(subtotal);"
        . "   }else{"
        . "   }"
        . "}");

$f->JavaScript(""
        . "function calculo_subtotal".$f->id."(){"
        . "   var cantidad=\$(\"cantidad\").value;"
        . "   var unitario=\$(\"unitario\").value;"
        . "   var iva=\$(\"iva\").value;"
        ."    var subtotal=\$(\"subtotal\").value;"
        . "   if(subtotal>0&&iva>=0){"
        . "     if(cantidad==0){ "
        . "       \$(\"cantidad\").value=\"1\";"
        . "     }else{"
        . "       "
        . "     }"
        . "     var base=parseFloat(subtotal)/(parseFloat(1)+parseFloat(iva));"
        . "     var unitario=parseFloat( base.toFixed(2) )/cantidad;"
        . "      \$(\"unitario\").value=parseFloat( unitario.toFixed(2) );"
        . "   }else{"
        . "   }" 
        . "}");

$f->JavaScript(""
        . "function cambio_producto".$f->id."(){"
        . "   var producto=\$(\"producto\").value;"
        . "   if(producto==\"0000000002\"){"
        . "     \$(\"iva\").value=0;"
        . "  }else{"
        . "     "
        . "  }"
        . "}");


$f->eChange("producto","cambio_producto".$f->id."();");
$f->eKeyUp("cantidad","calculo_unitario".$f->id."();");
$f->eKeyUp("unitario","calculo_unitario".$f->id."();");
$f->eKeyUp("iva","calculo_unitario".$f->id."();");
$f->eKeyUp("subtotal","calculo_subtotal".$f->id."();");
$f->JavaScript("MUI.titleWindow($('".($f->ventana)."'),\"Factura ".$valores['factura']." / Adicionar Elemento \");");
$f->JavaScript("MUI.resizeWindow($('".($f->ventana)."'),{width: 750,height:110});");
$f->JavaScript("MUI.centerWindow($('".$f->ventana."'));");$f->eClick("cancelar".$f->id,"MUI.closeWindow($('".$f->ventana."'));");
?>