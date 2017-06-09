<?php
/**
 * v1. Tres errores que dieron lugar a 17 previsiones.
 * v2. 2 errores que dieron lugar a 1 corrección y 4 validaciones.
 * v3. ???
 **/
$ROOT = (!isset($ROOT)) ? "../../../" : $ROOT;
require_once($ROOT . "modulos/facturacion/librerias/Configuracion.cnf.php");

@session_start();
require_once($ROOT . "librerias/excel/PHPExcel.php");
require_once($ROOT . "librerias/excel/PHPExcel/IOFactory.php");

$_SESSION["id-importador"] = time();

$file = $_REQUEST["archivo"];
$importado = $_REQUEST["importado"];

if (!file_exists($file)) {
    exit("No se encuentra el archivo $file .\n");
}

$Reader = PHPExcel_IOFactory::createReaderForFile($file);
$Reader->setReadDataOnly(true); // set this, to not read all excel properties, just data
$objXLS = $Reader->load($file);
//$value = $objXLS->getSheet(0)->getCell('A1')->getValue();
//$value = $objXLS->getSheet(0)->getCell('A1')->getCalculatedValue();
$sheet = $objXLS->getSheet(0);
$highestRow = $sheet->getHighestRow(); //Numero de la ultima fila
$highestColumn = $sheet->getHighestColumn(); //Numero de la ultima columna
$arraySheet = array();

for ($row = 1; $row <= $highestRow; $row++) {
    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, TRUE, TRUE); //  Read a row of data into an array
    array_push($arraySheet, $rowData);
}


// Leo la matriz completa asignandole etiquetas a los campos
$filas = array();
$etiquetas = $arraySheet[0][0];
for ($xf = 1; $xf < count($arraySheet); $xf++) {
    $xfila = $arraySheet[$xf][0];
    foreach ($xfila as $etiqueta => $valor) {
        $fila[trim(strtolower($etiquetas[$etiqueta]))] = $valor;
    }
    array_push($filas, $fila);
}
//    echo("<pre>");print_r($tabla);echo("</pre>");

for ($fila = 0; $fila < count($filas); $fila++) {
    analizador($filas[$fila],$importado);
}

function analizador($datos,$importado) {
    /**
     * 1. Debo importar la factura a la base de datos
     */
    $datos['importado'] =$importado;
    $datos['fecha'] = date("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($datos['fecha']));
    $datos['emision'] = date("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($datos['emision']));
    $suscriptor = suscriptor($datos["suscriptor"]);

    $db = new MySQL(Sesion::getConexion());
    $sql = "INSERT INTO `facturacion_servicios_complementarios_facturas` SET "
            . "`factura`='" . $datos['factura'] . "',"
            . "`suscriptor`='" . $datos['suscriptor'] . "',"
            . "`emision`='" . $datos['emision'] . "',"
            . "`fecha`='" . $datos['fecha'] . "',"
            . "`hora`='00:00:00',"
            . "`pago`='" . (($datos["creditos"] > 0) ? "CREDITO" : "CONTADO") . "',"
            . "`vencimiento`='" . $datos['fecha'] . "',"
            . "`observacion`='',"
            . "`creador`='0',"
            . "`relacion`='" . $datos['relacion'] . "',"
            . "`documento`='CC',"
            . "`identificacion`='',"
            . "`nombre`='" . strtoupper($suscriptor["nombres"] . " " . $suscriptor["apellidos"]) . "',"
            . "`direccion`='" . $datos['direccion'] . "',"
            . "`telefono`='',"
            . "`cuotas`='" . $datos['creditos'] . "',"
            . "`importado`='" . $datos['importado'] . "',"
            . "`ciudad`='BUGA'"
            . ";";
    $db->sql_query($sql);
    echo("<span style=\"color:red;font-family:arial;font-size:10px;\">".$sql . "</span><br>\n");
    $db->sql_close();
    //echo($sql."<br>");
    if ($datos["relacion"] == "COCALCANTA") {
        cocalcanta($datos);
    } else if ($datos["relacion"] == "COCAYMEFIL") {
        cocaymefil($datos);
    } else if ($datos["relacion"] == "COCAYRE") {
        cocayre($datos);
    } else if ($datos["relacion"] == "CONUEVAS") {
        conuevas($datos);
    }
}

/**
 *     [0] => Array
  (
  [item] => 1
  [fecha] => 42523
  [emision] => 42569
  [direccion] => K 14 No 13-33 PISO 2 APTO 201
  [suscriptor] => 35696
  [bm] => 66009
  [medidor] => 0
  [iva] => 10561
  [mdo] => 0
  [total] => 76570
  [creditos ] => 12
  [factura] => 876
  [relacion] => COCALCANTA
  )
 */
function cocalcanta($datos) {
    $db = new MySQL(Sesion::getConexion());
    $producto = "0000000001"; //Base Material
    $_SESSION["id-importador"]+=1;
    $sql = "INSERT INTO `facturacion_servicios_complementarios_facturas_elementos` SET "
            . "`elemento`='" . ($_SESSION["id-importador"]) . "',"
            . "`factura`='" . $datos['factura'] . "',"
            . "`producto`='$producto',"
            . "`cantidad`='1',"
            . "`unitario`='" . $datos['bm'] . "',"
            . "`iva`='0.19',"
            . "`importado`='" . $datos['importado'] . "',"
            . "`fecha`='" . (date('Y-m-d', time())) . "',"
            . "`hora`='" . (date('H:i:s', time())) . "'"
            . ";";
    $db->sql_query($sql);
    echo("<span style=\"color:black;font-family:arial;font-size:10px;\">".$sql . "</span><br>\n");
    $_SESSION["id-importador"]+=1;
    $producto = "0000000002"; //Mano de Obra
    $sql = "INSERT INTO `facturacion_servicios_complementarios_facturas_elementos` SET "
            . "`elemento`='" . ($_SESSION["id-importador"]) . "',"
            . "`factura`='" . $datos['factura'] . "',"
            . "`producto`='$producto',"
            . "`cantidad`='1',"
            . "`unitario`='" . $datos['mdo'] . "',"
            . "`iva`='0.0',"
            . "`importado`='" . $datos['importado'] . "',"
            . "`fecha`='" . (date('Y-m-d', time())) . "',"
            . "`hora`='" . (date('H:i:s', time())) . "'"
            . ";";
    $db->sql_query($sql);
    echo("<span style=\"color:black;font-family:arial;font-size:10px;\">".$sql . "</span><br>\n");
    $db->sql_close();
}

function cocaymefil($datos) {
    $db = new MySQL(Sesion::getConexion());
    $producto = "0000000001"; //Base Material
    $_SESSION["id-importador"]+=1;
    $sql = "INSERT INTO `facturacion_servicios_complementarios_facturas_elementos` SET "
            . "`elemento`='" . ($_SESSION["id-importador"]) . "',"
            . "`factura`='" . $datos['factura'] . "',"
            . "`producto`='$producto',"
            . "`cantidad`='1',"
            . "`unitario`='" . $datos['bm'] . "',"
            . "`iva`='0.19',"
            . "`importado`='" . $datos['importado'] . "',"
            . "`fecha`='" . (date('Y-m-d', time())) . "',"
            . "`hora`='" . (date('H:i:s', time())) . "'"
            . ";";
    $db->sql_query($sql);
    echo("<span style=\"color:black;font-family:arial;font-size:10px;\">".$sql . "</span><br>\n");
    $_SESSION["id-importador"]+=1;
    $producto = "0000000002"; //Mano de Obra
    $sql = "INSERT INTO `facturacion_servicios_complementarios_facturas_elementos` SET "
            . "`elemento`='" . ($_SESSION["id-importador"]) . "',"
            . "`factura`='" . $datos['factura'] . "',"
            . "`producto`='$producto',"
            . "`cantidad`='1',"
            . "`unitario`='" . $datos['mdo'] . "',"
            . "`iva`='0.0',"
            . "`importado`='" . $datos['importado'] . "',"
            . "`fecha`='" . (date('Y-m-d', time())) . "',"
            . "`hora`='" . (date('H:i:s', time())) . "'"
            . ";";
    $db->sql_query($sql);
    echo("<span style=\"color:black;font-family:arial;font-size:10px;\">".$sql . "</span><br>\n");
    $_SESSION["id-importador"]+=1;
    $producto = "0000000003"; //Medidor
    $sql = "INSERT INTO `facturacion_servicios_complementarios_facturas_elementos` SET "
            . "`elemento`='" . ($_SESSION["id-importador"]) . "',"
            . "`factura`='" . $datos['factura'] . "',"
            . "`producto`='$producto',"
            . "`cantidad`='1',"
            . "`importado`='" . $datos['importado'] . "',"
            . "`unitario`='" . $datos['medidor'] . "',"
            . "`iva`='0.19',"
            . "`fecha`='" . (date('Y-m-d', time())) . "',"
            . "`hora`='" . (date('H:i:s', time())) . "'"
            . ";";
    $db->sql_query($sql);
    echo("<span style=\"color:black;font-family:arial;font-size:10px;\">".$sql . "</span><br>\n");
    $db->sql_close();
}

function cocayre($datos) {
    $db = new MySQL(Sesion::getConexion());
    $producto = "0000000001"; //Base Material
    $_SESSION["id-importador"]+=1;
    $sql = "INSERT INTO `facturacion_servicios_complementarios_facturas_elementos` SET "
            . "`elemento`='" . ($_SESSION["id-importador"]) . "',"
            . "`factura`='" . $datos['factura'] . "',"
            . "`producto`='$producto',"
            . "`cantidad`='1',"
            . "`unitario`='" . $datos['bm'] . "',"
            . "`iva`='0.19',"
            . "`importado`='" . $datos['importado'] . "',"
            . "`fecha`='" . (date('Y-m-d', time())) . "',"
            . "`hora`='" . (date('H:i:s', time())) . "'"
            . ";";
    $db->sql_query($sql);
    echo("<span style=\"color:black;font-family:arial;font-size:10px;\">".$sql . "</span><br>\n");
    $_SESSION["id-importador"]+=1;
    $producto = "0000000002"; //Mano de Obra
    $sql = "INSERT INTO `facturacion_servicios_complementarios_facturas_elementos` SET "
            . "`elemento`='" . ($_SESSION["id-importador"]) . "',"
            . "`factura`='" . $datos['factura'] . "',"
            . "`producto`='$producto',"
            . "`cantidad`='1',"
            . "`importado`='" . $datos['importado'] . "',"
            . "`unitario`='" . $datos['mdo'] . "',"
            . "`iva`='0.0',"
            . "`fecha`='" . (date('Y-m-d', time())) . "',"
            . "`hora`='" . (date('H:i:s', time())) . "'"
            . ";";
    $db->sql_query($sql);
    echo("<span style=\"color:black;font-family:arial;font-size:10px;\">".$sql . "</span><br>\n");
    $db->sql_close();
}

function conuevas($datos) {
    $db = new MySQL(Sesion::getConexion());
    $producto = "0000000001"; //Base Material
    $_SESSION["id-importador"]+=1;
    $sql = "INSERT INTO `facturacion_servicios_complementarios_facturas_elementos` SET "
            . "`elemento`='" . ($_SESSION["id-importador"]) . "',"
            . "`factura`='" . $datos['factura'] . "',"
            . "`producto`='$producto',"
            . "`cantidad`='1',"
            . "`importado`='" . $datos['importado'] . "',"
            . "`unitario`='" . $datos['bm'] . "',"
            . "`iva`='0.19',"
            . "`fecha`='" . (date('Y-m-d', time())) . "',"
            . "`hora`='" . (date('H:i:s', time())) . "'"
            . ";";
    $db->sql_query($sql);
    echo("<span style=\"color:black;font-family:arial;font-size:10px;\">".$sql . "</span><br>\n");
    $_SESSION["id-importador"]+=1;
    $producto = "0000000002"; //Mano de Obra
    $sql = "INSERT INTO `facturacion_servicios_complementarios_facturas_elementos` SET "
            . "`elemento`='" . ($_SESSION["id-importador"]) . "',"
            . "`factura`='" . $datos['factura'] . "',"
            . "`producto`='$producto',"
            . "`cantidad`='1',"
            . "`importado`='" . $datos['importado'] . "',"
            . "`unitario`='" . $datos['mdo'] . "',"
            . "`iva`='0.0',"
            . "`fecha`='" . (date('Y-m-d', time())) . "',"
            . "`hora`='" . (date('H:i:s', time())) . "'"
            . ";";
    $db->sql_query($sql);
    echo("<span style=\"color:black;font-family:arial;font-size:10px;\">".$sql . "</span><br>\n");
    $_SESSION["id-importador"]+=1;
    $producto = "0000000003"; //Medidor
    $sql = "INSERT INTO `facturacion_servicios_complementarios_facturas_elementos` SET "
            . "`elemento`='" . ($_SESSION["id-importador"]) . "',"
            . "`factura`='" . $datos['factura'] . "',"
            . "`producto`='$producto',"
            . "`cantidad`='1',"
            . "`importado`='" . $datos['importado'] . "',"
            . "`unitario`='" . $datos['medidor'] . "',"
            . "`iva`='0.19',"
            . "`fecha`='" . (date('Y-m-d', time())) . "',"
            . "`hora`='" . (date('H:i:s', time())) . "'"
            . ";";
    $db->sql_query($sql);
    echo("<span style=\"color:black;font-family:arial;font-size:10px;\">".$sql . "</span><br>\n");
    $db->sql_close();
}

function suscriptor($suscriptor) {
    $db = new MySQL(Sesion::getConexion());
    $sql = "SELECT * FROM `suscriptores` WHERE `suscriptor`='" . $suscriptor . "' ;";
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    $db->sql_close();
    return($fila);
}

$objXLS->disconnectWorksheets();
unset($objXLS);
?>