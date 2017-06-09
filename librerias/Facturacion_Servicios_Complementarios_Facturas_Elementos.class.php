<?php

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

class Facturacion_Servicios_Complementarios_Facturas_Elementos {

  function crear($datos) {
    $db = new MySQL(Sesion::getConexion());
    $sql = "INSERT INTO `facturacion_servicios_complementarios_facturas_elementos` SET "
            . "`elemento`='" . $datos['elemento'] . "',"
            . "`factura`='" . $datos['factura'] . "',"
            . "`producto`='" . $datos['producto'] . "',"
            . "`cantidad`='" . $datos['cantidad'] . "',"
            . "`unitario`='" . $datos['unitario'] . "',"
            . "`iva`='" . $datos['iva'] . "',"
            . "`fecha`='" . $datos['fecha'] . "',"
            . "`hora`='" . $datos['hora'] . "'"
            . ";";
    $db->sql_query($sql);
    $db->sql_close();
  }

  function actualizar($elemento, $campo, $valor) {
    $db = new MySQL(Sesion::getConexion());
    $sql = "UPDATE `facturacion_servicios_complementarios_facturas_elementos` "
            . "SET `" . $campo . "`='" . $valor . "' "
            . "WHERE `elemento`='" . $elemento . "';";
    $db->sql_query($sql);
    $db->sql_close();
  }

  function eliminar($elemento) {
    $db = new MySQL(Sesion::getConexion());
    $sql = "DELETE FROM `facturacion_servicios_complementarios_facturas_elementos` "
            . "WHERE `elemento`='" . $elemento . "';";
    $db->sql_query($sql);
    $db->sql_close();
  }

  function consultar($elemento) {
    $db = new MySQL(Sesion::getConexion());
    $sql = "SELECT * FROM `facturacion_servicios_complementarios_facturas_elementos` "
            . "WHERE `elemento`='" . $elemento . "';";
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    $db->sql_close();
    return($fila);
  }
  
  
    function elementos($factura) {
      $productos=new Facturacion_Servicios_Complementarios_Facturas_Productos();
    $db = new MySQL(Sesion::getConexion());
    $sql = "SELECT * FROM `facturacion_servicios_complementarios_facturas_elementos` WHERE `factura`='" . $factura. "' ORDER BY `producto` ASC;";
    $consulta = $db->sql_query($sql);
    $filas=array();
    while($fila = $db->sql_fetchrow($consulta)){
      $producto=$productos->consultar($fila["producto"]);
      $fila["nombre"]=$producto["nombre"];
      $filas[$fila["producto"]]=$fila;
    }
    $db->sql_close(); 
    return($filas);
  }
  

}

?>