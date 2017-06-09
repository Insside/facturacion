<?php
if( !defined( __DIR__ ) ){define( __DIR__, dirname(__FILE__) );}

$html = "<html>";
$html.="<head>";
$html.="</head>";
$html.="<body>";
if (!isset($_REQUEST['accion'])) {
    $html.="<form action=\"\" method=\"post\" enctype=\"multipart/form-data\" target=\"_self\">";
    $html.="<div class=\"formulario\">";
    $html.="<div class=\"fila\">";
    $html.="<p>Seleccione el archivo que contiene el consolidado de facturas complementarias a cargar.  Recuerde que esta carga es definitiva, y solo realizara importación de nuevas facturas al sistema de facturación de servicios complementarios este sistema no se ha creado para actualización masiva de datos ni propósitos generales.</p>";
    $html.="</div>";
    $html.="<div class=\"fila\">";
    $html.="<input id=\"importado\" name=\"importado\" type=\"text\" value=\"".time()."-".date('Y-m-d', time())."\">";
    $html.="</div>";
    $html.="<div class=\"fila\">";
    $html.="<input name=\"accion\" type=\"hidden\" value=\"cargar\">";
    $html.="<input name=\"archivo\" type=\"file\">";
    $html.="</div>";
    $html.="<div class=\"fila\">";
    $html.="<input type=\"submit\" value=\"Enviar\">";
    $html.="</div>";
    $html.="</form>";
    $html.="</div>";
} else {
    //datos del arhivo
    $nombre = $_FILES['archivo']['name'];
    $tipo = $_FILES['archivo']['type'];
    $tamano = $_FILES['archivo']['size'];
    echo("<br><b>Arhivo</b>: ".$nombre);
    echo("<br><b>Tamaño Arhivo</b>: ".$tamano);
    //compruebo si las características del archivo son las que deseo
    if (!(strpos($nombre, "xls"))) {
        $html.="<br>La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .XLS<br><li>se permiten archivos de 10000 Kb máximo.</td></tr></table>";
    } else {
        if (move_uploaded_file($_FILES['archivo']['tmp_name'],time().$nombre)) {
            $html.="<br>El archivo ha sido cargado correctamente.";
            $directorio= array_diff(scandir(__DIR__), array('..', '.'));
            $html.=("<ol>");
            for($f=0;$f<count($directorio);$f++){
                if(strpos($directorio[$f],"xls")){
                    $html.=("<li><a href=\"importador.xhr.php?importado=".$_REQUEST["importado"]."&archivo=".$directorio[$f]."\">".$directorio[$f]."</a></li>");
                }
            }
            $html.=("</ol>");
        } else {
            $html.="Ocurrió algún error al subir el fichero. No pudo guardarse.";
        }
    }
}
$html.="</body>";
$html.="</html>";
echo($html);
?>