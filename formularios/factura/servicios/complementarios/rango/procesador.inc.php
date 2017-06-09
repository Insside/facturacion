<?php
$facturainicial=$_REQUEST["facturainicial"];
$facturafinal=$_REQUEST["facturafinal"];
echo("<iframe src=\"modulos/facturacion/formularios/factura/servicios/complementarios/visualizar/rango.pdf.php?facturainicial=$facturainicial&facturafinal=$facturafinal\" name=\"test\" height=\"450\" width=\"615\"></iframe>");
/** JavaScripts **/
$f->JavaScript("MUI.titleWindow($('".($f->ventana)."'),\"Imprimir Rango de Facturas\");");
$f->JavaScript("MUI.resizeWindow($('".($f->ventana)."'),{width: 640,height:480});");
$f->JavaScript("MUI.centerWindow($('".$f->ventana."'));");
?>