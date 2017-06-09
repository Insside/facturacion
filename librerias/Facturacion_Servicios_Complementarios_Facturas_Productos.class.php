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

/**
 * Description of Facturacion_Servicios_Complementarios_Facturas_Productos
 *
 * @author inssi
 */
class Facturacion_Servicios_Complementarios_Facturas_Productos {

  function consultar($producto) {
    $db = new MySQL(Sesion::getConexion());
    $sql = "SELECT * FROM `facturacion_servicios_complementarios_facturas_productos` "
            . "WHERE `producto`='" . $producto . "';";
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    $db->sql_close();
    return($fila);
  }

  function combo($name, $selected, $disabled = false, $change = "") {
    $cadenas = new Cadenas();
    $selected = empty($selected) ? "04" : $selected;
    $disabled = ($disabled) ? "disabled=\"disabled\"" : "";
    $db = new MySQL(Sesion::getConexion());
    $sql = "SELECT * FROM `facturacion_servicios_complementarios_facturas_productos` ORDER BY `nombre`";
    $consulta = $db->sql_query($sql);
    $html = ('<select name="' . $name . '"id="' . $name . '" ' . $disabled . ' onChange="' . $change . '" style="width:100%;">');
    $conteo = 0;
    while ($fila = $db->sql_fetchrow($consulta)) {
      $html.=('<option value="' . $fila['producto'] . '"' . (($selected == $fila['producto']) ? "selected" : "") . '> ' . $cadenas->capitalizar($fila['nombre']) . '</option>');
      $conteo++;
    }$db->sql_close();
    $html.=("</select>");
    return($html);
  }

}
