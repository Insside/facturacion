<?php

$ROOT = (!isset($ROOT)) ? "../../../../../../../" : $ROOT;
require_once($ROOT . "modulos/facturacion/librerias/Configuracion.cnf.php");
$usuario = Sesion::usuario();
$validaciones = new Validaciones();
$fscfe = new Facturacion_Servicios_Complementarios_Facturas_Elementos();
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2014 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.8.0, 2014-03-02
 */
$relacion = $validaciones->recibir("relacion");
$inicial = $validaciones->recibir("inicial");
$final = $validaciones->recibir("final");
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');
/** Include PHPExcel */
require_once($ROOT . 'librerias/excel/PHPExcel.php');
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
        ->setLastModifiedBy("Maarten Balliauw")
        ->setTitle("Office 2007 XLSX Test Document")
        ->setSubject("Office 2007 XLSX Test Document")
        ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
        ->setKeywords("office 2007 openxml php")
        ->setCategory("Test result file");
// Add some data

if ($relacion == "COCAYMEFIL") {
  $objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue('A1', "ITEM")
          ->setCellValue('B1', "FECHA")
          ->setCellValue('C1', "DIRECCIÓN")
          ->setCellValue('D1', "SUSCRIPTOR")
          ->setCellValue('E1', "MDO")
          ->setCellValue('F1', "BM")
          ->setCellValue('G1', "MEDIDOR")
          ->setCellValue('H1', "IVA")
          ->setCellValue('I1', "TOTAL")
          ->setCellValue('J1', "CREDITOS")
          ->setCellValue('K1', "FACTURA");
} elseif ($relacion == "CONUEVAS") {
  $objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue('A1', "ITEM")
          ->setCellValue('B1', "FECHA")
          ->setCellValue('C1', "DIRECCIÓN")
          ->setCellValue('D1', "SUSCRIPTOR")
          ->setCellValue('E1', "MDO")
          ->setCellValue('F1', "BM")
          ->setCellValue('G1', "MEDIDOR")
          ->setCellValue('H1', "IVA")
          ->setCellValue('I1', "TOTAL")
          ->setCellValue('J1', "CREDITOS")
          ->setCellValue('K1', "FACTURA");
} elseif ($relacion == "COCAYRE") {
  $objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue('A1', "ITEM")
          ->setCellValue('B1', "FECHA")
          ->setCellValue('C1', "DIRECCIÓN")
          ->setCellValue('D1', "SUSCRIPTOR")
          ->setCellValue('E1', "MDO")
          ->setCellValue('F1', "BM")
          ->setCellValue('G1', "IVA")
          ->setCellValue('H1', "TOTAL")
          ->setCellValue('I1', "CREDITOS")
          ->setCellValue('J1', "FACTURA");
} elseif ($relacion == "COCALCANTA") {
  $objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue('A1', "ITEM")
          ->setCellValue('B1', "FECHA")
          ->setCellValue('C1', "DIRECCIÓN")
          ->setCellValue('D1', "SUSCRIPTOR")
          ->setCellValue('E1', "MDO")
          ->setCellValue('F1', "BM")
          ->setCellValue('G1', "IVA")
          ->setCellValue('H1', "TOTAL")
          ->setCellValue('I1', "CREDITOS")
          ->setCellValue('J1', "FACTURA");
} elseif ($relacion == "OTROS") {
  $objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue('A1', "ITEM")
          ->setCellValue('B1', "FACTURA")
          ->setCellValue('C1', "FECHA")
          ->setCellValue('D1', "NOMBRE")
          ->setCellValue('E1', "ID")
          ->setCellValue('F1', "DIRECCIÓN")
          ->setCellValue('G1', "DESCRIPCIÓN")
          ->setCellValue('H1', "BASE")
          ->setCellValue('I1', "IVA")
          ->setCellValue('J1', "MO")
          ->setCellValue('K1', "TOTAL");
}

$db = new MySQL(Sesion::getConexion());
$sql = "SELECT * FROM `facturacion_servicios_complementarios_facturas` WHERE(`relacion`='$relacion' AND `factura`>='$inicial' AND `factura`<='$final' ) ORDER BY `factura` ASC;";
$consulta = $db->sql_query($sql);
$conteo = 1;

$T["MDO"] = 0;
$T["BM"] = 0;
$T["MEDIDOR"] = 0;
$T["IVA"] = 0;
$T["TOTAL"] = 0;

while ($fila = $db->sql_fetchrow($consulta)) {
  $conteo++;
  $elementos = $fscfe->elementos($fila["factura"]);
  $bm = !empty($elementos[1]["unitario"]) ? ($elementos[1]["unitario"] * $elementos[1]["cantidad"]) : "0";
  $mdo = !empty($elementos[2]["unitario"]) ? ($elementos[2]["unitario"] * $elementos[2]["cantidad"]) : "0";
  $medidor = !empty($elementos[3]["unitario"]) ? ($elementos[3]["unitario"] * $elementos[3]["cantidad"]) : "0";
  $bmiva = (!empty($elementos[1]["iva"])) ? $bm * $elementos[1]["iva"] : "0";
  $medidormiva = (!empty($elementos[3]["iva"])) ? $medidor * $elementos[3]["iva"] : "0";
  if ($relacion == "COCAYMEFIL") {
    $iva = round($bmiva) + round($medidormiva);
    $total = $mdo + $bm + $medidor + $iva;
    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A' . $conteo, $conteo - 1)
            ->setCellValue('B' . $conteo, $fila["vencimiento"])
            ->setCellValue('C' . $conteo, strtoupper($fila["direccion"]))
            ->setCellValue('D' . $conteo, strtoupper($fila["suscriptor"]))
            ->setCellValue('E' . $conteo, $mdo)
            ->setCellValue('F' . $conteo, $bm)
            ->setCellValue('G' . $conteo, $medidor)
            ->setCellValue('H' . $conteo, $iva)
            ->setCellValue('I' . $conteo, $total)
            ->setCellValue('J' . $conteo, $fila["cuotas"])
            ->setCellValue('K' . $conteo, $fila["factura"]);
    /** Sumatorias COCAYMEFIL* */
    $T["MDO"]+=$mdo;
    $T["BM"]+=$bm;
    $T["MEDIDOR"]+=$medidor;
    $T["IVA"]+=$iva;
    $T["TOTAL"]+=$total;
  } elseif ($relacion == "CONUEVAS") {//Bien
    $iva = round($bmiva) + round($medidormiva);
    $total = $mdo + $bm + $medidor + $iva;
    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A' . $conteo, $conteo - 1)
            ->setCellValue('B' . $conteo, $fila["vencimiento"])
            ->setCellValue('C' . $conteo, strtoupper($fila["direccion"]))
            ->setCellValue('D' . $conteo, strtoupper($fila["suscriptor"]))
            ->setCellValue('E' . $conteo, $mdo)
            ->setCellValue('F' . $conteo, $bm)
            ->setCellValue('G' . $conteo, $medidor)
            ->setCellValue('H' . $conteo, $iva)
            ->setCellValue('I' . $conteo, $total)
            ->setCellValue('J' . $conteo, $fila["cuotas"])
            ->setCellValue('K' . $conteo, $fila["factura"]);
    /** Sumatorias CONUEVAS * */
    $T["MDO"]+=$mdo;
    $T["BM"]+=$bm;
    $T["MEDIDOR"]+=$medidor;
    $T["IVA"]+=$iva;
    $T["TOTAL"]+=$total;
  } elseif ($relacion == "COCALCANTA") {//Bien
    $iva = round($bmiva) ;
    $total = $mdo + $bm + $iva;
    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A' . $conteo, $conteo - 1)
            ->setCellValue('B' . $conteo, $fila["vencimiento"])
            ->setCellValue('C' . $conteo, strtoupper($fila["direccion"]))
            ->setCellValue('D' . $conteo, strtoupper($fila["suscriptor"]))
            ->setCellValue('E' . $conteo, $mdo)
            ->setCellValue('F' . $conteo, $bm)
            ->setCellValue('G' . $conteo, round($bmiva))
            ->setCellValue('H' . $conteo, round($total))
            ->setCellValue('I' . $conteo, $fila["cuotas"])
            ->setCellValue('J' . $conteo, $fila["factura"]);
    /** Sumatorias COCALCANTA * */
    $T["MDO"]+=$mdo;
    $T["BM"]+=$bm;
    $T["IVA"]+=$iva;
    $T["TOTAL"]+=$total;
  } elseif ($relacion == "COCAYRE") {//Bien
    $iva = round($bmiva) ;
    $total = $mdo + $bm + $iva;
    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A' . $conteo, $conteo - 1)
            ->setCellValue('B' . $conteo, $fila["vencimiento"])
            ->setCellValue('C' . $conteo, strtoupper($fila["direccion"]))
            ->setCellValue('D' . $conteo, strtoupper($fila["suscriptor"]))
            ->setCellValue('E' . $conteo, $mdo)
            ->setCellValue('F' . $conteo, $bm)
            ->setCellValue('G' . $conteo, $iva)
            ->setCellValue('H' . $conteo, $total)
            ->setCellValue('I' . $conteo, $fila["cuotas"])
            ->setCellValue('J' . $conteo, $fila["factura"]);
    /** Sumatorias COCAYRE* */
    $T["MDO"]+=$mdo;
    $T["BM"]+=$bm;
    $T["IVA"]+=$iva;
    $T["TOTAL"]+=$total;
  } elseif ($relacion == "OTROS") {//REVISANDO
    $descripcion = "";
    $base = 0;
    $mdo = 0;
    $iva = 0;
    $total = 0;
    foreach ($elementos as $elemento) {
      if ($elemento["producto"] == "2") {
        $mdo = round($elemento["unitario"] * $elemento["cantidad"]);
        $total+=$mdo;
      } else {
        $descripcion.=$elemento["nombre"] . ", ";
        $base+=round($elemento["unitario"] * $elemento["cantidad"]);
        $iva+=round(($elemento["unitario"] * $elemento["cantidad"]) * $elemento["iva"]);
        $total+=round($base + $iva);
      }
    }
    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A' . $conteo, $conteo - 1)
            ->setCellValue('B' . $conteo, $fila["factura"])
            ->setCellValue('C' . $conteo, $fila["vencimiento"])
            ->setCellValue('D' . $conteo, strtoupper($fila["nombre"]))
            ->setCellValue('E' . $conteo, $fila["identificacion"])
            ->setCellValue('F' . $conteo, $fila["direccion"])
            ->setCellValue('G' . $conteo, strtoupper($descripcion))
            ->setCellValue('H' . $conteo, $base)
            ->setCellValue('I' . $conteo, $iva)
            ->setCellValue('J' . $conteo, $mdo)
            ->setCellValue('K' . $conteo, $total);
    /** Sumatorias Otros* */
    $T["MDO"]+=$mdo;
    $T["BM"]+=$base;
    $T["IVA"]+=$iva;
    $T["TOTAL"]+=$total;
  }
}
$db->sql_close();
/** Se calculan las sumatorias de las columnas una vez se halla finalizado la creación de las filas * */
if ($relacion == "COCAYMEFIL") {
  $objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue('A' . ($conteo + 1), "")
          ->setCellValue('B' . ($conteo + 1), "")
          ->setCellValue('C' . ($conteo + 1), "")
          ->setCellValue('D' . ($conteo + 1), "")
          ->setCellValue('E' . ($conteo + 1), $T["MDO"])
          ->setCellValue('F' . ($conteo + 1), $T["BM"])
          ->setCellValue('G' . ($conteo + 1), $T["MEDIDOR"])
          ->setCellValue('H' . ($conteo + 1), $T["IVA"])
          ->setCellValue('I' . ($conteo + 1), $T["TOTAL"])
          ->setCellValue('J' . ($conteo + 1), "")
          ->setCellValue('K' . ($conteo + 1), "");
} elseif ($relacion == "CONUEVAS") {
  $objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue('A' . ($conteo + 1), "")
          ->setCellValue('B' . ($conteo + 1), "")
          ->setCellValue('C' . ($conteo + 1), "")
          ->setCellValue('D' . ($conteo + 1), "")
          ->setCellValue('E' . ($conteo + 1), $T["MDO"])
          ->setCellValue('F' . ($conteo + 1), $T["BM"])
          ->setCellValue('G' . ($conteo + 1), $T["MEDIDOR"])
          ->setCellValue('H' . ($conteo + 1), $T["IVA"])
          ->setCellValue('I' . ($conteo + 1), $T["TOTAL"])
          ->setCellValue('J' . ($conteo + 1), "")
          ->setCellValue('K' . ($conteo + 1), "");
} elseif ($relacion == "COCAYRE") {
  $objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue('A' . ($conteo + 1), "")
          ->setCellValue('B' . ($conteo + 1), "")
          ->setCellValue('C' . ($conteo + 1), "")
          ->setCellValue('D' . ($conteo + 1), "")
          ->setCellValue('E' . ($conteo + 1), $T["MDO"])
          ->setCellValue('F' . ($conteo + 1), $T["BM"])
          ->setCellValue('G' . ($conteo + 1), $T["IVA"])
          ->setCellValue('H' . ($conteo + 1), $T["TOTAL"])
          ->setCellValue('I' . ($conteo + 1), "")
          ->setCellValue('J' . ($conteo + 1), "");
} elseif ($relacion == "COCALCANTA") {
  $objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue('A1', "")
          ->setCellValue('B1', "")
          ->setCellValue('C1', "")
          ->setCellValue('D1', "")
          ->setCellValue('E' . ($conteo + 1), $T["MDO"])
          ->setCellValue('F' . ($conteo + 1), $T["BM"])
          ->setCellValue('G' . ($conteo + 1), $T["IVA"])
          ->setCellValue('H' . ($conteo + 1), $T["TOTAL"])
          ->setCellValue('I' . ($conteo + 1), "")
          ->setCellValue('J' . ($conteo + 1), "");
} elseif ($relacion == "OTROS") {
  $objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue('A' . ($conteo + 1), "")
          ->setCellValue('B' . ($conteo + 1), "")
          ->setCellValue('C' . ($conteo + 1), "")
          ->setCellValue('D' . ($conteo + 1), "")
          ->setCellValue('E' . ($conteo + 1), "")
          ->setCellValue('F' . ($conteo + 1), "")
          ->setCellValue('G' . ($conteo + 1), "")
          ->setCellValue('H' . ($conteo + 1), $T["BM"])
          ->setCellValue('I' . ($conteo + 1), $T["IVA"])
          ->setCellValue('J' . ($conteo + 1), $T["MDO"])
          ->setCellValue('K' . ($conteo + 1), $T["TOTAL"]);
}












// Miscellaneous glyphs, UTF-8
$objPHPExcel->getActiveSheet()->setTitle('Planilla Automatica');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="reporte-' . time() . '.xls"');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>