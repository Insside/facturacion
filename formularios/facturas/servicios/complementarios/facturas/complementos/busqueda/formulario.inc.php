<?php
$fscf=new Facturacion_Servicios_Complementarios_Facturas();
/* 
 * Copyright (c) 2014, Jose Alexis Correa Valencia
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
$fechas=new Fechas();
/** Valores **/

$valores['criterio']=$validaciones->recibir("criterio");
$valores['valor']=$validaciones->recibir("valor");
$valores['fechainicial']=$validaciones->recibir("fechainicial");   
$valores['fechafinal']=$validaciones->recibir("fechafinal");

$s['fechainicial']=$validaciones->recibir("fechainicial");
$s['fechafinal']=$validaciones->recibir("fechafinal");

$valores['fechainicial']=empty($s['fechainicial'])?"2012-01-01":$s['fechainicial'];
$valores['fechafinal']=empty($s['fechafinal'])?$fechas->hoy():$s['fechafinal'];
/** Campos **/
$f->campos['criterio']=$fscf->criterios("criterio", $valores['criterio']);
$f->campos['valor']=$f->text("valor",$valores['valor'], "32","", false);
$f->campos['fechainicial']=$f->calendario("fechainicial",$valores['fechainicial'],"-1","2");
$f->campos['fechafinal']=$f->calendario("fechafinal",$valores['fechafinal'],"-1");
$f->campos['buscar'] = $f->button("buscar" . $f->id, "submit","Filtrar");
/** Celdas **/
$f->celdas["criterio"] = $f->celda("Criterio:", $f->campos['criterio']);
$f->celdas["valor"] = $f->celda("Valor:", $f->campos['valor']);
$f->celdas["fechainicial"] = $f->celda("Fecha Emisión Inicial:", $f->campos['fechainicial']);
$f->celdas["fechafinal"] = $f->celda("Fecha Emisión Final:", $f->campos['fechafinal']);
/** Filas **/
$f->fila["fila1"] = $f->fila($f->celdas["criterio"]);
$f->fila["fila2"] = $f->fila($f->celdas["valor"]);
$f->fila["fila3"] = $f->fila($f->celdas["fechainicial"]);
$f->fila["fila4"] = $f->fila($f->celdas["fechafinal"]);
/** Compilando **/
$f->filas($f->fila['fila1']);
$f->filas($f->fila['fila2']);
$f->filas($f->fila['fila3']);
$f->filas($f->fila['fila4']);
/** Botones **/
$f->botones($f->campos['buscar'], "inferior-izquierda");
?>
