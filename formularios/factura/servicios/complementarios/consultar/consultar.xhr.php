<?php
$ROOT = (!isset($ROOT)) ? "../../../../../../../" : $ROOT;
require_once($ROOT . "modulos/facturacion/librerias/Configuracion.cnf.php");
$sesion=new Sesion();
$validaciones=new Validaciones();
/*
 * Copyright (c) 2013, Alexis
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
$usuario=Sesion::usuario();
$v['uid']=$usuario['usuario'];
$v['criterio']=$validaciones->recibir("criterio");
$v['valor']=$validaciones->recibir("valor");
$v['inicio']=$validaciones->recibir("inicio");
$v['fin']=$validaciones->recibir("fin");
$v['transaccion']=$validaciones->recibir("transaccion");
$v['factura']=$validaciones->recibir("factura");
$v['url']="modulos/facturacion/formularios/factura/servicios/complementarios/consultar/consultar.json.php?"
        . "factura=".$v['factura']
        . "&uid=".$v['uid']
        . "&criterio=".$v['criterio']
        . "&valor=".$v['valor']
        . "&inicio=".$v['inicio']
        . "&fin=".$v['fin']
        . "&transaccion=".$v['transaccion'];

/** Creación de la tabla **/
$tabla = new Grid(array("id" =>"Grid_". time(), "url" => $v['url'],"perPageOptions"=>array(100,200)));
$tabla->boton('btnCrear', 'Crear',array("directo"=>$v['factura'],"itabla"=>"xx"), "MUI.Facturacion_Servicios_Complementarios_Factura_Elemento_Crear", "crear");
$tabla->boton('btnModificar', 'Modificar', 'elemento', "MUI.Facturacion_Servicios_Complementarios_Factura_Elemento_Modificar", "edit");
$tabla->boton('btnEliminar', 'Eliminar', 'elemento', "MUI.Facturacion_Servicios_Complementarios_Factura_Elemento_Eliminar", "eliminar");
//$tabla->boton('btnRoles', 'Roles', 'usuario', "MUI.Usuarios_Usuario_Roles", "pRoles");
$tabla->columna('cFactura', 'F', 'factura', 'string', '40', 'center', 'false');
$tabla->columna('cElemento', 'E', 'elemento','string', '90', 'center', 'false');
$tabla->columna('cElemento', 'P', 'producto','string', '40', 'center', 'false');
$tabla->columna('cDetalles', 'Detalles','detalles', 'string', '200', 'left', 'false');
$tabla->columna('cCantidad', 'Cantidad','cantidad', 'date', '90', 'right', 'false');
$tabla->columna('cUnitario', 'V/Unitario','unitario', 'string', '90', 'right', 'false');
$tabla->columna('cIva', 'IVA', 'iva', 'string', '100', 'right', 'false');
$tabla->columna('cUnitario', 'V/IVA','viva', 'string', '90', 'right', 'false');
$tabla->columna('cSubtotal', 'Subtotal', 'subtotal', 'string', '100', 'right', 'false');
$tabla->columna('cFecha', 'Fecha', 'fecha', 'date', '90', 'center', 'false');
$tabla->columna('cHora', 'Hora', 'hora','string', '90', 'center', 'false');
$tabla->generar();
?>