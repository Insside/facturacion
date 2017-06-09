<?php 
$ROOT = (!isset($ROOT)) ? "../../../" : $ROOT;
require_once($ROOT . "modulos/facturacion/librerias/Configuracion.cnf.php");
require_once($ROOT . "modulos/aplicacion/librerias/Aplicacion_Modulos_Componentes.class.php");
require_once($ROOT . "modulos/facturacion/librerias/Facturacion_Modulo.class.php");
/**
 * @package Insside
 * @subpackage Usuarios
 * @author Jose Alexis Correa Valencia <jalexiscv@gmail.com>
 * @copyright (c) 2015 www.insside.com
 */

if (!class_exists('Facturacion_Componentes')) {

    class Facturacion_Componentes extends Aplicacion_Modulos_Componentes {

        private $modulo;
        private $permiso;
        private $datos;

        function Facturacion_Componentes() {
            $modulo = new Facturacion_Modulo();
            $f = new Fechas();
            $this->modulo = $modulo->modulo;
            $this->permiso = "FACTURACION-ACCESO";
            /** Regeneracion del Menu * */
            $this->datos[0] = array("componente" => $this->codigo("0", "0"), "herencia" => "0", "titulo" => "Facturación", "descripcion" => "Modulo Facturación", "funcion" => "1465232665", "icono" => "i033x033_usuarios", "peso" => "2", "estado" => "ACTIVO", "fecha" => $f->hoy(), "permiso" => $this->permiso, "hora" => $f->ahora(), "creador" => "0000000000");
            /** Componentes * */
            $this->datos[1] = array("componente" => $this->codigo("1", "0"), "herencia" => $this->datos[0]['componente'], "titulo" => "Facturación", "descripcion" => "Complementarios", "funcion" => "0000000000", "icono" => "i033x033_componente", "peso" => "1", "estado" => "ACTIVO", "fecha" => $f->hoy(), "permiso" => $this->permiso, "hora" => $f->ahora(), "creador" => "0000000000");
            //$this->datos[2] = array("componente" => $this->codigo("2", "0"), "herencia" => $this->datos[0]['componente'], "titulo" => "Roles", "descripcion" => "Componente Roles", "funcion" => "0000000000", "icono" => "i033x033_componente", "peso" => "2", "estado" => "ACTIVO", "fecha" => $f->hoy(), "permiso" => $this->permiso, "hora" => $f->ahora(), "creador" => "0000000000");
            //$this->datos[3] = array("componente" => $this->codigo("3", "0"), "herencia" => $this->datos[0]['componente'], "titulo" => "Permisos", "descripcion" => "Componente Permisos", "funcion" => "0000000000", "icono" => "i033x033_componente", "peso" => "3", "estado" => "ACTIVO", "fecha" => $f->hoy(), "permiso" => $this->permiso, "hora" => $f->ahora(), "creador" => "0000000000");
            //$this->datos[4] = array("componente" => $this->codigo("4", "0"), "herencia" => $this->datos[0]['componente'], "titulo" => "Perfiles", "descripcion" => "Componente Perfiles", "funcion" => "0000000000", "icono" => "i033x033_componente", "peso" => "4", "estado" => "ACTIVO", "fecha" => $f->hoy(), "permiso" => $this->permiso, "hora" => $f->ahora(), "creador" => "0000000000");
            //$this->datos[5] = array("componente" => $this->codigo("5", "0"), "herencia" => $this->datos[0]['componente'], "titulo" => "Áreas", "descripcion" => "Componente Áreas", "funcion" => "0000000000", "icono" => "i033x033_componente", "peso" => "5", "estado" => "ACTIVO", "fecha" => $f->hoy(), "permiso" => $this->permiso, "hora" => $f->ahora(), "creador" => "0000000000");
            $this->datos[6] = array("componente" => $this->codigo("6", "0"), "herencia" => $this->datos[0]['componente'], "titulo" => "Configuración", "descripcion" => "Componente Configuración", "funcion" => "0000000000", "icono" => "i033x033_componente", "peso" => "5", "estado" => "ACTIVO", "fecha" => $f->hoy(), "permiso" => $this->permiso, "hora" => $f->ahora(), "creador" => "0000000000");
            /** Opciones * */
            $this->datos['011'] = array("componente" => $this->codigo("1", "1"), "herencia" => $this->datos[1]['componente'], "titulo" => "Servicios", "descripcion" => "Complementarios", "funcion" => "1462461099", "icono" => "i033x033_componente", "peso" => "1", "estado" => "ACTIVO", "fecha" => $f->hoy(), "permiso" => $this->permiso, "hora" => $f->ahora(), "creador" => "0000000000");
            //$this->datos['021'] = array("componente" => $this->codigo("2", "1"), "herencia" => $this->datos[2]['componente'], "titulo" => "Roles", "descripcion" => "Listado General", "funcion" => "0000000042", "icono" => "i033x033_componente", "peso" => "1", "estado" => "ACTIVO", "fecha" => $f->hoy(), "permiso" => $this->permiso, "hora" => $f->ahora(), "creador" => "0000000000");
            //$this->datos['031'] = array("componente" => $this->codigo("3", "1"), "herencia" => $this->datos[3]['componente'], "titulo" => "Permisos", "descripcion" => "Listado General", "funcion" => "0000000037", "icono" => "i033x033_componente", "peso" => "1", "estado" => "ACTIVO", "fecha" => $f->hoy(), "permiso" => $this->permiso, "hora" => $f->ahora(), "creador" => "0000000000");
            //$this->datos['041'] = array("componente" => $this->codigo("4", "1"), "herencia" => $this->datos[4]['componente'], "titulo" => "Perfiles", "descripcion" => "Listado General", "funcion" => "0020040010", "icono" => "i033x033_componente", "peso" => "1", "estado" => "ACTIVO", "fecha" => $f->hoy(), "permiso" => $this->permiso, "hora" => $f->ahora(), "creador" => "0000000000");
            $this->datos['061'] = array("componente" => $this->codigo("6", "1"), "herencia" => $this->datos[6]['componente'], "titulo" => "Servicios", "descripcion" => "Facturables", "funcion" => "0000000000", "icono" => "i033x033_componente", "peso" => "1", "estado" => "ACTIVO", "fecha" => $f->hoy(), "permiso" => $this->permiso, "hora" => $f->ahora(), "creador" => "0000000000");
        }

        function regenerar() {
            $datos = $this->datos;
            foreach ($datos as $dato) {
                $this->evaluar($dato);
            }
        }

        function evaluar($dato) {
            $consulta = $this->consultar($dato['componente']);
            if (isset($consulta['componente'])) {
                if ($dato['hora'] != $consulta['hora']) {
                  $this->actualizar($dato['componente'], "herencia", $dato['herencia']);
                    $this->actualizar($dato['componente'], "titulo", $dato['titulo']);
                    $this->actualizar($dato['componente'], "descripcion", $dato['descripcion']);
                    $this->actualizar($dato['componente'], "funcion", $dato['funcion']);
                    $this->actualizar($dato['componente'], "icono", $dato['icono']);
                    $this->actualizar($dato['componente'], "fecha", $dato['fecha']);
                    $this->actualizar($dato['componente'], "hora", $dato['hora']);
                    $this->actualizar($dato['componente'], "peso", $dato['peso']);
                    $this->actualizar($dato['componente'], "permiso", $dato['permiso']);
                } else {
                    
                }
            } else {
                echo($this->crear($dato));
            }
        }

        function codigo($componente, $opcion) {
            return(str_pad($this->modulo, 2, "0", STR_PAD_LEFT) . str_pad($componente, 2, "0", STR_PAD_LEFT) . str_pad($opcion, 2, "0", STR_PAD_LEFT));
        }

        /**
         * Este metodo retorna el codigo modular del componente generalmente es 
         * utilizado en la generacion del menu. 
         * @return type
         */
        function modulo() {
            return($this->datos[0]['componente']);
        }

    }

}

?>