<?php

$ROOT = (!isset($ROOT)) ? "../../../" : $ROOT;
require_once($ROOT . "librerias/Configuracion.cnf.php");
/*
 * Copyright (c) 2016, inssi
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

class Facturacion_Servicios_Complementarios_Facturas {

  var $sesion;
  var $fechas;
  var $usuarios;
  var $permisos;
  var $formularios;

  function Facturacion_Servicios_Complementarios_Facturas() {
    $this->permisos = new Usuarios_Permisos();
    $this->sesion = new Sesion();
    $this->fechas = new Fechas();
    $this->usuarios = new Usuarios();
    $this->formularios = new Forms(time());
  }

  function crear($datos) {
    $db = new MySQL(Sesion::getConexion());
    $sql = "INSERT INTO `facturacion_servicios_complementarios_facturas` SET "
            . "`factura`='" . $datos['factura'] . "',"
            . "`suscriptor`='" . $datos['suscriptor'] . "',"
            . "`emision`='" . $datos['emision'] . "',"
            . "`fecha`='" . $datos['fecha'] . "',"
            . "`hora`='" . $datos['hora'] . "',"
            . "`pago`='" . $datos['pago'] . "',"
            . "`vencimiento`='" . $datos['vencimiento'] . "',"
            . "`observacion`='" . $datos['observacion'] . "',"
            . "`creador`='" . $datos['creador'] . "',"
            . "`relacion`='" . $datos['relacion'] . "',"
            . "`documento`='" . $datos['documento'] . "',"
            . "`identificacion`='" . $datos['identificacion'] . "',"
            . "`nombre`='" . $datos['nombre'] . "',"
            . "`direccion`='" . $datos['direccion'] . "',"
            . "`telefono`='" . $datos['telefono'] . "',"
            . "`cuotas`='" . $datos['cuotas'] . "',"
            . "`ciudad`='" . $datos['ciudad'] . "'"
            . ";";
    $db->sql_query($sql);
    echo("<pre>" . $sql . "</pre>");
    $db->sql_close();
    echo($sql);
  }

  function actualizar($factura, $campo, $valor) {
    $db = new MySQL(Sesion::getConexion());
    $sql = "UPDATE `facturacion_servicios_complementarios_facturas` "
            . "SET `" . $campo . "`='" . $valor . "' "
            . "WHERE `factura`='" . $factura . "';";
    $db->sql_query($sql);
    $db->sql_close();
  }

  function eliminar($factura) {
    $db = new MySQL(Sesion::getConexion());
    $sql = "DELETE FROM `facturacion_servicios_complementarios_facturas` "
            . "WHERE `factura`='" . $factura . "';";
    $db->sql_query($sql);
    $db->sql_close();
  }

  function consultar($factura) {
    $db = new MySQL(Sesion::getConexion());
    $sql = "SELECT * FROM `facturacion_servicios_complementarios_facturas` "
            . "WHERE `factura`='" . $factura . "';";
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    $db->sql_close();
    return($fila);
  }

  function suscriptor($suscriptor) {
    $db = new MySQL(Sesion::getConexion());
    $sql = "SELECT * FROM `suscriptores` WHERE `suscriptor`='" . $suscriptor . "';";
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    $db->sql_close();
    return($fila);
  }

  /**
   * Retorna el siguiente numero consecutivo asignable a una factura a partir del mayor numero encontrado 
   * sumandole +uno.
   * @return type
   */
  function consecutivo() {
    $db = new MySQL(Sesion::getConexion());
    $sql = "SELECT `factura` "
            . "FROM `facturacion_servicios_complementarios_facturas` "
            . "ORDER BY `factura` "
            . "DESC LIMIT 1;";
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    $db->sql_close();
    return(($fila['factura'] + 1));
    return($consecutivo);
  }

  /**
   *  Esta funcion calcula el valor de la sumatoria de
   *  de los subtotales de los elementos de una factura
   */
  function subtotales($factura) {
    $db = new MySQL(Sesion::getConexion());
    $sql = "SELECT * FROM `facturacion_servicios_complementarios_facturas_elementos` WHERE `factura`=\"$factura\";";
    $consulta = $db->sql_query($sql);
    $subtotal = 0;
    while ($fila = $db->sql_fetchrow($consulta)) {
      $neto = $fila["cantidad"] * $fila["unitario"];
      $iva = $neto * $fila["iva"];
      $subtotal+=$neto + $iva;
    }
    $db->sql_close();
    return($subtotal);
  }

  /**
   *  Esta funcion calcula el valor de la sumatoria de
   *  de los ivas de los elementos de una factura
   */
  function iva($factura) {
    $db = new MySQL(Sesion::getConexion());
    $sql = "SELECT * FROM `facturacion_servicios_complementarios_facturas_elementos` WHERE `factura`=\"$factura\";";
    $consulta = $db->sql_query($sql);
    $riva = 0;
    while ($fila = $db->sql_fetchrow($consulta)) {
      $neto = ($fila["cantidad"] * $fila["unitario"]);
      $iva = $neto * $fila["iva"];
      $riva+=$iva;
    }
    $db->sql_close();
    return($riva);
  }

  /**
   *  Retorna un elemento html tipo select que contiene los posibles criterios a usar en el componente de 
   * busqueda
   * 
   * @param type $nombre
   * @param type $seleccionado
   * @return type
   */
  function criterios($nombre, $seleccionado) {
    $etiquetas = array("Factura", "Suscriptor","Identificación","Teléfono","Nombre");
    $valores = array("factura", "suscriptor","identificacion","telefono","nombre");
    return($this->formularios->combo($nombre, $etiquetas, $valores, $seleccionado, ""));
  }

}

?>