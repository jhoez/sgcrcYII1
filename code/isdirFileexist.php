<?php
// AÑADIR ESTO A LA FUNCTION DE eliminarArchivo
if(is_dir("./files/pdfs"))
        {
            $filename = "reporte_alumnos.pdf";
            $route = base_url("files/pdfs/reporte_alumnos.pdf");
            if(file_exists("./files/pdfs/".$filename))
            {
                header('Content-type: application/pdf');
                readfile($route);
            }
        }

?>
