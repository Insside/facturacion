<?php
/** Variables **/
$cadenas = new Cadenas();
$fechas = new Fechas();
$validaciones = new Validaciones();
/** Valores **/
$itable=$validaciones->recibir("itable");
$valores['factura']=$validaciones->recibir("_factura");
/** Campos **/
if(!empty($itable)){$f->oculto("itable",$itable);}
$f->campos['facturainicial']=$f->iTextBox("facturainicial","numeros","1");
$f->campos['facturafinal']=$f->iTextBox("facturafinal","numeros","2");
$f->campos['ayuda']=$f->button("ayuda".$f->id, "button","Ayuda");
$f->campos['cancelar']=$f->button("cancelar".$f->id, "button","Cancelar");
$f->campos['continuar']=$f->button("continuar".$f->id, "submit","Continuar");
/** Celdas **/
$f->celdas["facturainicial"]=$f->celda("Factura Inicial:",$f->campos['facturainicial']);
$f->celdas["facturafinal"]=$f->celda("Factura Final:",$f->campos['facturafinal']);
/** Filas **/
$f->fila["fila1"]=$f->fila($f->celdas["facturainicial"].$f->celdas["facturafinal"]);
$f->filas($f->fila['fila1']);
/** Botones **/
$f->botones($f->campos['ayuda'], "inferior-izquierda");
$f->botones($f->campos['cancelar'], "inferior-derecha");
$f->botones($f->campos['continuar'], "inferior-derecha");
/** JavaScripts **/
$f->JavaScript("MUI.titleWindow($('".($f->ventana)."'),\"Imprimir Rango de Facturas\");");
$f->JavaScript("MUI.resizeWindow($('".($f->ventana)."'),{width: 400,height:120});");
$f->JavaScript("MUI.centerWindow($('".$f->ventana."'));");$f->eClick("cancelar".$f->id,"MUI.closeWindow($('".$f->ventana."'));");
?>