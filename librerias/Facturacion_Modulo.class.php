<?php 
$ROOT = (!isset($ROOT)) ? "../../../" : $ROOT;
require_once($ROOT . "modulos/usuarios/librerias/Configuracion.cnf.php");
/**
 * @package Insside
 * @subpackage Usuarios
 * @author Jose Alexis Correa Valencia <jalexiscv@gmail.com>
 * @copyright (c) 2015 www.insside.com
 */
/**
 * Description of Tesoreria_Modulo
 *
 * @author Jose Alexis Correa Valencia <jalexiscv@gmail.com>
 */
if (!class_exists('Facturacion_Modulo')) {

    class Facturacion_Modulo {

        public $modulo = "301";
        private $nombre = "Facturacion";
        private $titulo = "Modulo de Facturación.";
        private $descripcion = "Modulo Control de Usuarios.";
        private $creador = "0";
        private $permisos;

        function Facturacion_Modulo() {
            $consulta = $this->crear($this->modulo, $this->nombre, $this->titulo, $this->descripcion, $this->creador);
            $this->permisos = new Usuarios_Permisos();
            $this->permisos->permiso_crear($this->modulo, "FACTURACION-ACCESO", "Acceso Modulo de Facturación", "Permite acceder al modulo de Facturación.", "0000000000");
            $this->permisos->permiso_crear(
                    $this->modulo, 
                    "FACTURACION-SERVICIOS-COMPLEMENTARIOS-ACCESO", 
                    "Acceso componente facturación de servicios complementarios.", 
                    "Permite acceder al componente de facturación de servicios complementarios.", 
                    "0000000000");
            $this->permisos->permiso_crear(
                    $this->modulo, 
                    "FACTURACION-SERVICIOS-COMPLEMENTARIOS-FACTURAS-CREAR", 
                    "Facturar Servicios Complementarios.", 
                    "Permite crear facturas de servicios complementarios", 
                    "0000000000");
             $this->permisos->permiso_crear(
                    $this->modulo, 
                    "FACTURACION-SERVICIOS-COMPLEMENTARIOS-FACTURAS-MODIFICAR", 
                    "Modificar Facturas de Servicios Complementarios.", 
                    "Permite modificar la información facturas de servicios complementarios", 
                    "0000000000");
             $this->permisos->permiso_crear(
                    $this->modulo, 
                    "FACTURACION-SERVICIOS-COMPLEMENTARIOS-FACTURAS-VISUALIZAR", 
                    "Visualizar Facturas de Servicios Complementarios.", 
                    "Permite visualizar e imprimir facturas de servicios complementarios", 
                    "0000000000");
              $this->permisos->permiso_crear(
                    $this->modulo, 
                    "FACTURACION-SERVICIOS-COMPLEMENTARIOS-FACTURAS-RANGO", 
                    "Visualizar e imprimir rango.", 
                    "Permite visualizar e imprimir facturas de servicios segun un rango especificado", 
                    "0000000000");
              $this->permisos->permiso_crear(
                    $this->modulo, 
                    "FACTURACION-SERVICIOS-COMPLEMENTARIOS-FACTURAS-EXPORTAR", 
                    "Exportar facturación.", 
                    "Permite exportar un reporte de las facturas generadas en formato de excel segun un rango especificado", 
                    "0000000000");
            
         }

        function crear($modulo, $nombre, $titulo, $descripcion, $creador = "0") {
            $fechas = new Fechas();
            $db = new MySQL(Sesion::getConexion());
            $sql = "SELECT * FROM `aplicacion_modulos` WHERE `modulo` =" . $modulo . ";";
            $consulta = $db->sql_query($sql);
            $conteo = $db->sql_numrows($consulta);
            if ($conteo == 0) {
                $sql = "INSERT INTO `aplicacion_modulos` SET ";
                $sql.="`modulo` = '" . $modulo . "', ";
                $sql.="`nombre` = '" . $nombre . "', ";
                $sql.="`titulo` = '" . $titulo . "', ";
                $sql.="`descripcion` = '" . $descripcion . "', ";
                $sql.="`fecha` = '" . $fechas->hoy() . "', ";
                $sql.="`hora` = '" . $fechas->ahora() . "', ";
                $sql.="`creador` = '" . $creador . "';";
                $consulta = $db->sql_query($sql);
            } else {
                
            }
            $db->sql_close();
            return($sql);
        }

    }

}
?>