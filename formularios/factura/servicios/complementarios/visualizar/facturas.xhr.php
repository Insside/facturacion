<?php
$ROOT = (!isset($ROOT)) ? "../../../../" : $ROOT;
require_once($ROOT . "librerias/Configuracion.cnf.php");
require_once($ROOT . "modulos/facturacion/librerias/Configuracion.cnf.php");
require_once($ROOT . "librerias/pdf/fpdf.php");
require_once($ROOT . "librerias/pdf/fpdi.php");
require_once($ROOT . "modulos/solicitudes/librerias/Configuracion.cnf.php");
$suscriptores=new Suscriptores();
$f=new Facturacion_Cocalcanta();
$v=new Validaciones();
$codigos=new Codigos();
$suscriptor=$suscriptores->consultar($v->recibir("suscriptor"));
$factura=$f->consultar($suscriptor["suscriptor"]);
$nombre=($suscriptor["nombres"]." ".$suscriptor["apellidos"]);
$direccion=$suscriptor["direccion"];
$identificacion=$suscriptor["identificacion"];

// Hoja tamaño del modelo
$pdf = new FPDI();
$pdf->setSourceFile($ROOT . "modulos/facturacion/formularios/facturas/factura.pdf");
$tid = $pdf -> importPage(1);
$size = $pdf->getTemplateSize($tid);
$pdf -> AddPage();
//$pdf ->useTemplate($tplIdx, null, null, $size['w'], $size['h'], true);
$pdf->useTemplate($tid, 10, 10, 190);
$pdf->SetFont('times','B',12);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY(155, 38);
$pdf->Write(0,$suscriptor["suscriptor"]);
$pdf->SetXY(35,38);
$pdf->Write(0,  strtoupper($nombre));
$pdf->SetXY(35,48);
$pdf->Write(0,  strtoupper($identificacion));
$pdf->SetXY(145,50);
$pdf->Write(0,  strtoupper("20      11      2015"));
$pdf->SetXY(35,58);
$pdf->Write(0,  strtoupper($direccion));
$pdf->SetXY(120,58);
$pdf->Write(0,  strtoupper("BUGA"));
$pdf->SetXY(88,68);
$pdf->Write(0,  strtoupper("X"));
$pdf->SetXY(35,98);
$pdf->Write(0,  strtoupper("MATERIAL"));
$pdf->SetXY(165,98);
$pdf->Write(0,($factura["bm"]));
$pdf->SetXY(165,171);
$pdf->Write(0,($factura["iva"]));
$pdf->SetXY(165,176);
$pdf->Write(0,($factura["total"]));

$pdf -> Output();
//$ROOT = (!isset($ROOT)) ? "../../../../" : $ROOT;
//require_once($ROOT . "modulos/solicitudes/librerias/Configuracion.cnf.php");
///*
// * Copyright (c) 2014, Jose Alexis Correa Valencia
// * All rights reserved.
// *
// * Redistribution and use in source and binary forms, with or without
// * modification, are permitted provided that the following conditions are met:
// *
// * * Redistributions of source code must retain the above copyright notice, this
// *   list of conditions and the following disclaimer.
// * * Redistributions in binary form must reproduce the above copyright notice,
// *   this list of conditions and the following disclaimer in the documentation
// *   and/or other materials provided with the distribution.
// *
// * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
// * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
// * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
// * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
// * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
// * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
// * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
// * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
// * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
// * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
// * POSSIBILITY OF SUCH DAMAGE.
// */
//
//$validaciones=new Validaciones();
//$transaccion=$validaciones->recibir("transaccion");
//$trasmision = $validaciones->recibir("trasmision");
//$url['formulario']=$ROOT . "modulos/solicitudes/formularios/constancia/formulario.inc.php";
//$url['procesador']=$ROOT . "modulos/solicitudes/formularios/constancia/procesador.inc.php";
//
//$f = new Forms($transaccion);
//echo($f->apertura());
//if (empty($trasmision)) {
//  require_once($url['formulario']);
//} else {
//  require_once($url['procesador']);
//}
//echo($f->generar());
//echo($f->controles());
//echo($f->cierre());
?>
