<?php
$v=new Validaciones();
$archivos=new Solicitudes_Archivos();
$solicitud=$validaciones->recibir("solicitud");

$f->oculto("solicitud",$v->recibir("solicitud"));
$info_archivo="<p>En este formulario podrá adjuntar los archivos de la digitalización de los diferentes documentos físicos relacionados con la solicitud. Para adjuntar un documento deberá hacer clic en Adjuntar archivo local-Examinar. Recuerde que “no debe tener el archivo abierto” cuando lo vaya a adjuntar y debe verificar que el archivo esté guardado con un nombre “corto”.</p>";
$info_importar="<p>El archivo a sido cargado exitosamente, ahora puede proceder a realizar el proceso de importación.</p>";
$f->campos['archivo']=$f->archivo("archivo".$f->id,".xls","");
$f->campos['archivo_nombre']=$f->text("archivo_nombre_".$f->id,"","","",true);
$f->campos['importacion']=$f->iTextBox("importacion_".$f->id,"",time());
$f->campos['importar']=$f->button("importar".$f->id,"submit","Importar");
$f->campos['adjuntar']=$f->button("adjuntar".$f->id,"button","Adjuntar");
// Celdas
$f->celdas['info_archivo']=$f->celda("",$info_archivo);
$f->celdas['info_importar']=$f->celda("",$info_importar);
$f->celdas['archivo']=$f->celda("Archivo a cargar (*.xls):",$f->campos['archivo']);
$f->celdas['archivo_nombre']=$f->celda("Archivo Preparado:",$f->campos['archivo_nombre']);
$f->celdas['importacion']=$f->celda("Marca de Importación:",$f->campos['importacion']);
$f->celdas['siguiente']=$f->campos['adjuntar'];
// Filas
$f->fila["info_archivo"]=$f->fila($f->celdas['info_archivo'],"","fila_info_archivo_".$f->id);
$f->fila["info_importar"]=$f->fila($f->celdas['info_importar'],"","fila_info_importar_".$f->id);
$f->fila["archivo"]=$f->fila($f->celdas['archivo'],"","fila_archivo_".$f->id);
$f->fila["archivo_nombre"]=$f->fila($f->celdas['archivo_nombre'],"","fila_archivo_nombre_".$f->id);
$f->fila["importacion"]=$f->fila($f->celdas['importacion'],"","fila_importacion_".$f->id);
//Compilacion
$f->filas($f->fila['info_archivo']);
$f->filas($f->fila['archivo']);
$f->filas($f->fila['info_importar']);
$f->filas($f->fila['importacion']);
$f->filas($f->fila['archivo_nombre']);

$f->botones($f->campos['adjuntar'],"inferior-derecha");
$f->botones($f->campos['importar'],"inferior-derecha");

$f->JavaScript("$(\"fila_info_importar_".$f->id."\").setStyle(\"visibility\",\"collapse\");");
$f->JavaScript("$(\"fila_importacion_".$f->id."\").setStyle(\"visibility\",\"collapse\");");
$f->JavaScript("$(\"fila_archivo_nombre_".$f->id."\").setStyle(\"visibility\",\"collapse\");");
$f->JavaScript("$(\"importar".$f->id."\").setStyle(\"visibility\",\"collapse\");");


$f->windowTitle("Importar Planilla de Facturas","3.2");
$f->windowResize(array("autoresize"=>false,"width"=>"400","height"=>"400"));
$f->windowCenter();

$f->eClick("adjuntar".$f->id,"  
    var mooploadHandler = new MUI.Upload({
            url:'modulos/facturacion/formularios/importador/servicios/complementarios/archivo.php?fid=".$f->id."',
            onRequest:function(){
                console.log('start');
            },
            onComplete: function(response){
                $(\"fila_info_archivo_".$f->id."\").hide();
                $(\"fila_archivo_".$f->id."\").hide();
                $(\"adjuntar".$f->id."\").hide();

                $(\"importar".$f->id."\").setStyle(\"visibility\",\"visible\");
                $(\"fila_info_importar_".$f->id."\").setStyle(\"visibility\",\"visible\");
                $(\"fila_importacion_".$f->id."\").setStyle(\"visibility\",\"visible\");
                $(\"fila_archivo_nombre_".$f->id."\").setStyle(\"visibility\",\"visible\");
                //$(\"fila_importacion_".$f->id."\").setStyle(\"width\",\"100%\");    

                $(\"archivo_nombre_".$f->id."\").value=response;   

            },
            onProgress: function(e) {
                if (e.lengthComputable) {
                     var percentComplete = e.loaded / e.total;
                     console.log('percent completed: ' + percentComplete.toString());
                 } else {
                    // Unable to compute progress information since the total size is unknown
                 }
            }
        });
        mooploadHandler.addFile($(\"archivo".$f->id."\"));
        mooploadHandler.send();
");

?>