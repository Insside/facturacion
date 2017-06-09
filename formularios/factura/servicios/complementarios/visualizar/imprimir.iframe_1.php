<?php

$ROOT = (!isset($ROOT)) ? "../../../../../" : $ROOT;
require_once($ROOT . "librerias/Configuracion.cnf.php");
require_once($ROOT . "librerias/Moneda.class.php");
require_once($ROOT . "modulos/facturacion/librerias/Configuracion.cnf.php");
require_once($ROOT . "librerias/pdf/fpdf.php");
require_once($ROOT . "librerias/pdf/fpdi.php");
require_once($ROOT . "modulos/solicitudes/librerias/Configuracion.cnf.php");
setlocale(LC_MONETARY, 'es_CO');
$suscriptores = new Suscriptores();
$moneda=new Moneda();
$v = new Validaciones();
$codigos = new Codigos();
$origen = $v->recibir("origen");
$suscriptor = $suscriptores->consultar($v->recibir("suscriptor"));

$db = new MySQL(Sesion::getConexion());
$sql = "SELECT * FROM `facturacion_" . $origen . "` WHERE `suscriptor`='" . $suscriptor["suscriptor"] . "';";
$consulta = $db->sql_query($sql);
$fila = $db->sql_fetchrow($consulta);
$db->sql_close();

$factura = $fila;
$nombre = ($suscriptor["nombres"] . " " . $suscriptor["apellidos"]);
$direccion = $suscriptor["direccion"];
$identificacion = $suscriptor["identificacion"];
$emision=$factura["emision"];
$porciones = explode("-", $emision);
$anno=$porciones[0];
$mes=$porciones[1];
$dia=$porciones[2];

// Hoja tamaño del modelo
$pdf = new FPDI();
$pdf->setSourceFile($ROOT . "modulos/facturacion/formularios/facturas/factura.pdf");
$tid = $pdf->importPage(1);
$size = $pdf->getTemplateSize($tid);
$pdf->AddPage();
//$pdf ->useTemplate($tplIdx, null, null, $size['w'], $size['h'], true);
$pdf->useTemplate($tid, 10, 10, 190);
$pdf->SetFont('courier', '', 11);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY(157, 43);
$matricula=((int)($suscriptor["suscriptor"]));
$pdf->Write(0,$matricula);
$pdf->SetXY(30, 43);
$pdf->Write(0, strtoupper($nombre));
$pdf->SetXY(40, 54);
$pdf->Write(0, strtoupper($identificacion));
$pdf->SetXY(145, 57);

$pdf->Write(0,$dia);
$pdf->SetXY(162, 57);
$pdf->Write(0,$mes);
$pdf->SetXY(175, 57);
$pdf->Write(0,$anno);
$pdf->SetXY(30, 64);
$pdf->Write(0, strtoupper($direccion));
$pdf->SetXY(120, 63);
$pdf->Write(0, strtoupper("BUGA"));

$creditos =(int)($factura["creditos"]);
if($creditos==1){
  $pdf->SetXY(48, 76);
  $pdf->Write(0, strtoupper("X"));
}else{
  $pdf->SetXY(78, 76);
  $pdf->Write(0, strtoupper("X"));
}

$pdf->SetXY(136, 188);
$iva=number_format($factura["iva"],0);
$pdf->Cell(50,0,$iva,0,0, 'R' ); 
$pdf->SetXY(136, 194);
$total=number_format($factura["total"],0);
$pdf->Cell(50,0,$total,0,0, 'R' ); 

if (isset($factura["bm"])) {
  $bm = ((double) $factura["bm"]);
  if ($bm > 0.0) {
    $pdf->SetXY(35, 102);
    $pdf->Write(0, strtoupper("MATERIAL"));
    $pdf->SetXY(136, 102);
    $bm=number_format($bm,0);
    $pdf->Cell(50,0,$bm,0,0, 'R' ); 
  }
}

if (isset($factura["bm"])) {
  $mdo = ((double) $factura["mdo"]);
  if ($mdo > 0.0) {
    $pdf->SetXY(35, 106);
    $pdf->Write(0, strtoupper("MANO DE OBRA"));
    $pdf->SetXY(136, 106);
    $mdo=number_format($mdo,0);
    $pdf->Cell(50,0,$mdo,0,0, 'R' ); 
  }
}

if (isset($factura["medidor"])) {
  $medidor = ((double) $factura["medidor"]);
  if ($medidor > 0.0) {
    $pdf->SetXY(35, 111);
    $pdf->Write(0, strtoupper("MEDIDOR"));
    $pdf->SetXY(136,111);
    $medidor=number_format($medidor,0);
    $pdf->Cell(50,0,$medidor,0,0, 'R' ); 
  }
}




$pdf->Output();
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
