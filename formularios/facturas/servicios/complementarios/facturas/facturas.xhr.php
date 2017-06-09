<?php

$ROOT = (!isset($ROOT)) ? "../../../../../../../" : $ROOT;
require_once($ROOT . "modulos/facturacion/librerias/Configuracion.cnf.php");
$sesion = new Sesion();
$validaciones = new Validaciones();
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
$usuario = Sesion::usuario();
$v['uid'] = $usuario['usuario'];
$v['criterio'] = $validaciones->recibir("criterio");
$v['valor'] = $validaciones->recibir("valor");
$v['inicio'] = $validaciones->recibir("inicio");
$v['fin'] = $validaciones->recibir("fin");
$v['transaccion'] = $validaciones->recibir("transaccion");
$v['url'] = "modulos/facturacion/formularios/facturas/servicios/complementarios/facturas/facturas.json.php?"
        . "uid=" . $v['uid']
        . "&criterio=" . $v['criterio']
        . "&valor=" . $v['valor']
        . "&inicio=" . $v['inicio']
        . "&fin=" . $v['fin']
        . "&transaccion=" . $v['transaccion'];

/** Creación de la tabla * */
$tabla = new Grid(array("id" =>"Grid_". time(), "url" => $v['url'], "perPageOptions" => array(100, 200)));
$tabla->boton('btnVer', 'Visualizar', 'factura', "MUI.Facturacion_Servicios_Complementarios_Factura_Visualizar", "pAbrir");
$tabla->boton('btnCrear', 'Crear', '', "MUI.Facturacion_Servicios_Complementarios_Factura_Crear", "new");
$tabla->boton('btnModificar', 'Modificar', 'factura', "MUI.Facturacion_Servicios_Complementarios_Factura_Modificar", "new");
$tabla->boton('btnExplorar', 'Explorar', 'factura', "MUI.Facturacion_Servicios_Complementarios_Factura_Explorar", "edit");
$tabla->boton('btnRango', 'Rango', '', "MUI.Facturacion_Servicios_Complementarios_Factura_Visualizar_Rango", "rango");
$tabla->boton('btnBuscar', 'Buscar', '', "MUI.Facturacion_Servicios_Complementarios_Busqueda", "pBuscar");
$tabla->boton('btnDescargar', 'Exportar', '', "MUI.Facturacion_Servicios_Complementarios_Facturacion_Exportar", "exportar");
$tabla->boton('btnImportar', 'Importar', '', "MUI.Facturacion_Servicios_Complementarios_Facturacion_Importar", "importar");
$tabla->columna('cFactura', 'Factura', 'factura', 'string', '70', 'center', 'false');
$tabla->columna('cSuscriptor', 'Suscriptor', 'suscriptor', 'string', '90', 'center', 'false');
$tabla->columna('cDetalles', 'Detalles', 'detalles', 'string', '350', 'left', 'false');
$tabla->columna('cIva', 'IVA', 'iva', 'string', '70', 'right', 'false');
$tabla->columna('cTotal', 'Total', 'total', 'string', '80', 'right', 'false');
$tabla->columna('cFecha', 'Emisión', 'emision', 'date', '90', 'center', 'false');
$tabla->columna('cVencimiento', 'Liquidacion', 'vencimiento', 'date', '90', 'center', 'false');
$tabla->columna('cHora', 'Hora', 'hora', 'time', '70', 'left', 'false');
$tabla->columna('cPago', 'Forma/Pago', 'pago', 'string', '100', 'left', 'false');
$tabla->columna('cRelacion', 'Relacion', 'relacion', 'string', '90', 'center', 'false');
$tabla->generar();
?>