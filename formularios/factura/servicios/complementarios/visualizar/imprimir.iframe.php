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

//Margenes
$ml="50";//MArgen Izquierda
$mt="";//Margen Superior
// Hoja tamaño del modelo
$pdf = new FPDI();
$pdf->setSourceFile($ROOT . "modulos/comercial/formularios/factura/imprimir/factura3.pdf");
$tid = $pdf->importPage(1);
$size = $pdf->getTemplateSize($tid);
$pdf->AddPage();
$pdf ->useTemplate($tid, null, null,300,300, true);
//$pdf->useTemplate($tid, 10, 10, 390);
$pdf->SetFont('Helvetica', 'B', 13);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY($ml+200,39);$matricula=((int)($suscriptor["suscriptor"]));$pdf->Write(0,$matricula);
$pdf->SetXY($ml,39);$pdf->Write(0, strtoupper($nombre));
$pdf->SetXY($ml+20, 48);$pdf->Write(0, strtoupper($identificacion));

$pdf->SetXY($ml+185, 51);$pdf->Write(0,$dia);
$pdf->SetXY($ml+205, 51);$pdf->Write(0,$mes);
$pdf->SetXY($ml+225, 51);$pdf->Write(0,$anno);

$pdf->SetXY($ml, 59);$pdf->Write(0, strtoupper($direccion));
$pdf->SetXY($ml+140,59);$pdf->Write(0, strtoupper("BUGA"));

$creditos =(int)($factura["creditos"]);
if($creditos==1){
  $pdf->SetXY(73,69);
  $pdf->Write(0, strtoupper("X"));
}else{
  $pdf->SetXY(90,69);
  $pdf->Write(0, strtoupper("X"));
}

$pdf->SetXY($ml+190, 172);$iva=number_format($factura["iva"],0);$pdf->Cell(50,0,$iva,0,0, 'R' ); 
$pdf->SetXY($ml+190, 178);$total=number_format($factura["total"],0);$pdf->Cell(50,0,$total,0,0, 'R' ); 

if (isset($factura["bm"])) {
  $bm = ((double) $factura["bm"]);
  if ($bm > 0.0) {
    $pdf->SetXY($ml, 102);$pdf->Write(0, strtoupper("MATERIAL"));
    $pdf->SetXY($ml+190, 102);$bm=number_format($bm,0);$pdf->Cell(50,0,$bm,0,0, 'R' ); 
  }
}

if (isset($factura["bm"])) {
  $mdo = ((double) $factura["mdo"]);
  if ($mdo > 0.0) {
    $pdf->SetXY($ml, 106);$pdf->Write(0, strtoupper("MANO DE OBRA"));
    $pdf->SetXY($ml+190, 106);$mdo=number_format($mdo,0);
    $pdf->Cell(50,0,$mdo,0,0, 'R' ); 
  }
}

if (isset($factura["medidor"])) {
  $medidor = ((double) $factura["medidor"]);
  if ($medidor > 0.0) {
    $pdf->SetXY($ml, 111); $pdf->Write(0, strtoupper("MEDIDOR"));
    $pdf->SetXY($ml+190,111);$medidor=number_format($medidor,0);$pdf->Cell(50,0,$medidor,0,0, 'R' ); 
  }
}

$pdf->Output();
?>