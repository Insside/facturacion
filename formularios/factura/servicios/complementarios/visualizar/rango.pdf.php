<?php

$ROOT = (!isset($ROOT)) ? "../../../../../../../" : $ROOT;
require_once($ROOT . "modulos/facturacion/librerias/Configuracion.cnf.php");
require_once($ROOT . "librerias/Configuracion.cnf.php");
require_once($ROOT . "librerias/Moneda.class.php");
require_once($ROOT . "librerias/pdf/fpdf.php");
require_once($ROOT . "librerias/pdf/fpdi.php");
setlocale(LC_MONETARY, 'es_CO');
$cadenas=new Cadenas();
$suscriptores = new Suscriptores();
$moneda = new Moneda();
$v = new Validaciones();
$codigos = new Codigos();
$fscf = new Facturacion_Servicios_Complementarios_Facturas();
$fscp = new Facturacion_Servicios_Complementarios_Facturas_Productos();
/** Recibo los datos de la factura * */
$inicial = $v->recibir("facturainicial");
$final = $v->recibir("facturafinal");  

//Margenes
  $ml = "35"; //MArgen Izquierda 
  $mt = ""; //Margen Superior
// Hoja tamaño del modelo
  $pdf = new FPDI();
  $pdf->setSourceFile($ROOT . "modulos/facturacion/formularios/factura/servicios/complementarios/visualizar/originalfinal.pdf");
  $tid = $pdf->importPage(1);
  $size = $pdf->getTemplateSize($tid);
  

for ($f= $inicial; $f <=$final; $f++) {
  $factura = $fscf->consultar($f);
  $consecutivo = "AB-" . str_pad($factura["factura"], 5, "0", STR_PAD_LEFT);
  $nombre = $factura["nombre"];
  $direccion = $factura["direccion"];
  $identificacion = $factura["identificacion"];

  for ($i = 2; $i > 0; $i--) {
    $pdf->AddPage();
    $pdf->useTemplate($tid, 20, 0, 170);
    $pdf->SetFont('Helvetica', 'B', 11);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetXY($ml + 111, 20.5);
    $pdf->Write(0, $consecutivo);
    $pdf->SetXY($ml + 100, 42.5);
    $matricula = ((int) ($factura["suscriptor"]));
    $pdf->Write(0, $matricula);
    if ($i == 2) {
      $pdf->SetXY($ml + 57, 30);
      $pdf->Write(0, " - ORIGINAL - ");
    } else {
      $pdf->SetXY($ml + 60, 30);
      $pdf->Write(0, " - COPIA - ");
    }
    $pdf->SetXY($ml, 42.5);
    $pdf->Write(0, utf8_decode(strtoupper($nombre)));
    $pdf->SetXY($ml, 53.6);
    $pdf->Write(0, strtoupper($identificacion));
    $pdf->SetXY($ml + 80, 53.6);
    $pdf->Write(0, strtoupper($factura["pago"]));
    $pdf->SetXY($ml + 52, 53.6);
    $pdf->Write(0, strtoupper($factura["emision"]));
    $pdf->SetXY($ml + 111, 53.6);
//$pdf->Write(0, strtoupper($factura["vencimiento"]));
    $pdf->SetXY($ml, 64.5);
    $pdf->Write(0, strtoupper($direccion));
    $pdf->SetXY($ml + 75, 64.5);
    $pdf->Write(0, strtoupper("BUGA"));


    $db = new MySQL(Sesion::getConexion());
    $sql = "SELECT * FROM `facturacion_servicios_complementarios_facturas_elementos` WHERE `factura`='" . $factura["factura"] . "';";
    $consulta = $db->sql_query($sql);
    $yp = 80;
    $ypi = 4;
    while ($fila = $db->sql_fetchrow($consulta)) {
      $producto = $fscp->consultar($fila["producto"]);
      $fila["detalles"] = "" . utf8_decode($cadenas->capitalizar($producto["nombre"])) . "";
      //$fila["viva"]= "$".number_format($fila["unitario"]*$fila["iva"]);
      $neto = "$" . number_format($fila["unitario"] * $fila["cantidad"]);
      $fila["unitario"] = "$" . number_format($fila["unitario"]);
      $pdf->SetXY($ml + 20, $yp);
      $pdf->Write(0, strtoupper($fila["detalles"]));
      $pdf->SetXY($ml + 88, $yp);
      $pdf->Cell(50, 0, ($neto), 0, 0, 'R');
      $yp+=$ypi;
    }
    $db->sql_close();

    $factura["total"] = "$" . number_format($fscf->subtotales($factura["factura"]));
    $factura["iva"] = "$" . number_format($fscf->iva($factura["factura"]));
    $pdf->SetXY($ml + 88, 154);
    $pdf->Cell(50, 0, $factura["iva"], 0, 0, 'R');
    $pdf->SetXY($ml + 88, 161);
    $pdf->Cell(50, 0, $factura["total"], 0, 0, 'R');

    /** QR * */
    $codigo = "{\"factura\":" . $factura["factura"] . ",\"valor\":" . $factura["total"] . "}";
    $codigo_qr = $codigos->generar("http://www.aguasdebuga.net/?codigo=" . md5($codigo));
    $imagen = $ROOT . "librerias/" . $codigo_qr;
    $pdf->Image($imagen, $ml + 57, 184, 26, 26);
  }
}

$pdf->Output();
?>