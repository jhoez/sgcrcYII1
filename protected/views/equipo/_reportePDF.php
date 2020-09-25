<?php if($equipo !== null):?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <style>
        * {
            margin:0px;
            padding:0px;
        }
        body {
            font-family: arial;
            font-size: 16x;
        }

        #pdfheader {
          width:688px;
          max-width: 688px;
          height:50px;
        }
        .fecha {
            text-align:right;
            margin-top:10px;
        }
        #titlereport{
            margin:0px auto;
            text-align:center;
            margin-top:10px;
        }

        .contentre {
            margin-top:10px;
        }
        .items {
            width:988px;
            max-width: 988px;
            border-collapse: collapse;
        }
        #thead {
            width:98.2px;
            max-width: 98.2px;
            padding:5px 0px;
            color: #fff;
            background-color: #a70139;
            font-size:12px;
            vertical-align: middle;
            text-align: center;
        }
        #tbody {
            background-color: #cdcdcd;
            width:98.2px;
            max-width: 98.2px;
            padding:5px 0px;
            vertical-align: middle;
            text-align:center;
        }
        #pdfpie {
            width:679px;
            max-width: 679px;
            height:50px;
            margin-top: 20px;
            /*position: relative;
            bottom: 0px;*/
        }
        </style>
    </head>
<body>
    <div class="pdfheader">
        <!--<img id="pdfheader" src="/home/aborigen/www/sgci/printpdf/bannerfundabit.jpg">-->
        <img id="pdfheader" src="<?php echo Yii::getPathOfAlias('webroot')."/img/printpdf/bannerfundabit.jpg"; ?>">
    </div>
    <div class="fecha"><b>Reporte Fecha: </b><?=date("d/m/Y");?></div>
    <div id="titlereport"> <h2>Reporte de Canaimitas <?php setlocale(LC_TIME, 'es_ES.UTF-8'); echo ucwords((string)strftime("%B"));?></h2> </div>
    <div class="contentre">
        <table class="items" cellpadding="7">
            <!-- primera fila -->
            <thead>
                <tr>
                    <th id="thead">ID</th>
                    <th id="thead">CIAT</th>
                    <th id="thead">Institución</th>
                    <th id="thead">Representante</th>
                    <th id="thead">Cedula</th>
                    <th id="thead">Docente</th>
                    <th id="thead">Telefono</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td id="tbody"><?=$equipo->ideq;?></td>
                    <td id="tbody"><?=$equipo->eqrep->repciat->sede;?></td>
                    <td id="tbody"><?=$equipo->eqrep->repinst->nombinst;?></td>
                    <td id="tbody"><?=$equipo->eqrep->nombre;?></td>
                    <td id="tbody"><?=$equipo->eqrep->cedula;?></td>
                    <td id="tbody"><?=$valor = $equipo->eqrep->docente == 'true' ? 'maestro' : 'representante';?></td>
                    <td id="tbody"><?=$equipo->eqrep->telf;?></td>
                </tr>
            </tbody>
        </table>
        <table class="items" cellpadding="7">
            <!-- segunda fila -->
            <thead>
                <tr>
                    <th id="thead">Estudiante</th>
                    <th id="thead">Grado</th>
                    <th id="thead">Graduado</th>
                    <th id="thead">Equipo</th>
                    <th id="thead">Serial equipo</th>
                    <th id="thead">Status</th>
                    <th id="thead">Diagnostico</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td id="tbody">
                        <?php
                        foreach ($equipo->eqrep->repestu as $value) {
                            if( $value['idrep'] == $equipo->eqrep->idrep ){
                                echo $value['nombestu'];
                            }
                        }
                        ?>
                    </td>
                    <td id="tbody">
                        <?php
                        foreach ($equipo->eqrep->repestu as $estudent) {
                            if( $estudent['idrep'] == $equipo->eqrep->idrep ){
                                foreach( $estudent->niveduc as $nivel ){
                                    if ( $nivel->idestu == $estudent->idestu) {
                                        echo $nivel['nivel'];
                                    }
                                }
                            }
                        }
                        ?>
                    </td>
                    <td id="tbody">
                        <?php
                        foreach ($equipo->eqrep->repestu as $estudent) {
                            if( $estudent['idrep'] == $equipo->eqrep->idrep ){
                                foreach( $estudent->niveduc as $nivel ){
                                    if ( $nivel->idestu == $estudent->idestu) {
                                        echo $graduado = $nivel['graduado'] == 'true' ? 'si' : 'no';
                                    }
                                }
                            }
                        }
                        ?>
                    </td>
                    <td id="tbody"><?=$equipo->eqversion;?></td>
                    <td id="tbody"><?=$equipo->eqserial;?></td>
                    <td id="tbody"><?=$equipo->eqstatus;?></td>
                    <td id="tbody"><?=$equipo->diagnostico;?></td>
                </tr>
            </tbody>
        </table>
        <table class="items" cellpadding="7">
            <!-- tercera fila -->
            <thead>
                <tr>
                    <th id="thead">Observacion</th>
                    <th id="thead">F software</th>
                    <th id="thead">F pantalla</th>
                    <th id="thead">F tarjeta madre</th>
                    <th id="thead">F teclado</th>
                    <th id="thead">F carga</th>
                    <th id="thead">F general</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td id="tbody"><?=$equipo->observacion;?></td>
                    <td id="tbody">
                        <?php
                        foreach ($equipo->eqfsoft as $fsoft) {
                            if( $fsoft['ideq'] == $equipo->ideq ){
                                echo $fsoft['fsoft'];
                            }
                        }
                        ?>
                    </td>
                    <td id="tbody">
                        <?php
                        foreach ($equipo->eqfpant as $fpant) {
                            if( $fpant['ideq'] == $equipo->ideq ){
                                echo $fpant['fpant'];
                            }
                        }
                        ?>
                    </td>
                    <td id="tbody">
                        <?php
                        foreach ($equipo->eqftarj as $ftarj) {
                            if( $ftarj['ideq'] == $equipo->ideq ){
                                echo $ftarj['ftarj'];
                            }
                        }
                        ?>
                    </td>
                    <td id="tbody">
                        <?php
                        foreach ($equipo->eqftec as $ftec) {
                            if( $ftec['ideq'] == $equipo->ideq ){
                                echo $ftec['ftec'];
                            }
                        }
                        ?>
                    </td>
                    <td id="tbody">
                        <?php
                        foreach ($equipo->eqfcarg as $fcarg) {
                            if( $fcarg['ideq'] == $equipo->ideq ){
                                echo $fcarg['fcarg'];
                            }
                        }
                        ?>
                    </td>
                    <td id="tbody">
                        <?php
                        foreach ($equipo->eqfgen as $fgen) {
                            if( $fgen['ideq'] == $equipo->ideq ){
                                echo $fgen['fgen'];
                            }
                        }
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="pdfpie">
        <!--<img id="pdfpie" src="/home/aborigen/www/sgci/printpdf/cintillomppe.jpg">-->
        <img id="pdfheader" src="<?php echo Yii::getPathOfAlias('webroot').'/img/printpdf/cintillomppe.jpg' ?>" >
    </div>
</body>
</html>
<?php endif;?>
