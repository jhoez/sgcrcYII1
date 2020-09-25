<?php if($equipo !== null):?>
<style>
        * {
            margin:0px;
            padding:0px;
            font-family: arial;
            font-size: 16px;
        }

        #imgheader, #imgfooter {
            width:100%;
            height:50px;
            margin: 0px;
            padding: 0px;
        }

        .fecha {
            text-align:right;
            margin-right: 10px;
            margin-bottom:10px;
        }
        #titlereport{
            margin:0px auto;
            text-align:center;
            margin-bottom:3px;
        }

        .contentre {
            margin-top:25px;
        }
        .items {
            width:700px;
            max-width: 700px;
            margin-left:46.5px;
            margin-right:46.5px;
            border-collapse: collapse;
        }
        #thead {
            width:100px;
            max-width: 100px;
            padding:5px 0px;
            color: #fff;
            background-color: #a70139;
            font-size:12px;
            vertical-align: middle;
            text-align: center;
        }
        #tbody {
            background-color: #cdcdcd;
            width:100px;
            max-width: 100px;
            padding:5px 0px;
            font-size:10px;
            vertical-align: middle;
            text-align:center;
        }
</style>

<page backtop="15" backbottom="15" backleft="0" backright="0">
    <bookmark title="Reporte asistencia" level="0" ></bookmark>
    <page_header>
        <img id="imgheader" src="<?php echo Yii::getPathOfAlias('webroot')."/img/printpdf/bannerfundabit.jpg" ?>" alt="">
    </page_header>

    <div class="fecha"><b>Reporte Fecha: </b><?=date("d/m/Y");?></div>
    <div id="titlereport">
        <?php if (!empty($finicio) && !empty($ffin)) {
            echo "<h4>Reporte de Canaimitas desde ".$finicio." hasta ".$ffin."</h4>";
        }else if(!empty($mes)){
            setlocale(LC_TIME, 'es_ES.UTF-8');
            $fech = DateTime::createFromFormat('!m',$mes);
            echo "<h4>Reporte de Canaimitas de ".ucwords( (string)strftime("%B",(int)$fech->getTimestamp()) )."</h4>";
        }?>
    </div>
    <?php foreach($equipo as $data): ?>
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
                    <td id="tbody"><?=$data->ideq;?></td>
                    <td id="tbody"><?=$data->eqrep->repciat->sede;?></td>
                    <td id="tbody"><?=$data->eqrep->repinst->nombinst;?></td>
                    <td id="tbody"><?=$data->eqrep->nombre;?></td>
                    <td id="tbody"><?=$data->eqrep->cedula;?></td>
                    <td id="tbody"><?=$valor = $data->eqrep->docente == 'true' ? 'maestro' : 'representante';?></td>
                    <td id="tbody"><?=$data->eqrep->telf;?></td>
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
                        foreach ($data->eqrep->repestu as $value) {
                            if( $value['idrep'] == $data->eqrep->idrep ){
                                echo $value['nombestu'];
                            }
                        }
                        ?>
                    </td>
                    <td id="tbody">
                        <?php
                        foreach ($data->eqrep->repestu as $estudent) {
                            if( $estudent['idrep'] == $data->eqrep->idrep ){
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
                        foreach ($data->eqrep->repestu as $estudent) {
                            if( $estudent['idrep'] == $data->eqrep->idrep ){
                                foreach( $estudent->niveduc as $nivel ){
                                    if ( $nivel->idestu == $estudent->idestu) {
                                        echo $graduado = $nivel['graduado'] == 'true' ? 'si' : 'no';
                                    }
                                }
                            }
                        }
                        ?>
                    </td>
                    <td id="tbody"><?=$data->eqversion;?></td>
                    <td id="tbody"><?=$data->eqserial;?></td>
                    <td id="tbody"><?=$data->eqstatus;?></td>
                    <td id="tbody"><?=$data->diagnostico;?></td>
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
                    <td id="tbody"><?=$data->observacion;?></td>
                    <td id="tbody">
                        <?php
                        foreach ($data->eqfsoft as $fsoft) {
                            if( $fsoft['ideq'] == $data->ideq ){
                                echo $fsoft['fsoft'];
                            }
                        }
                        ?>
                    </td>
                    <td id="tbody">
                        <?php
                        foreach ($data->eqfpant as $fpant) {
                            if( $fpant['ideq'] == $data->ideq ){
                                echo $fpant['fpant'];
                            }
                        }
                        ?>
                    </td>
                    <td id="tbody">
                        <?php
                        foreach ($data->eqftarj as $ftarj) {
                            if( $ftarj['ideq'] == $data->ideq ){
                                echo $ftarj['ftarj'];
                            }
                        }
                        ?>
                    </td>
                    <td id="tbody">
                        <?php
                        foreach ($data->eqftec as $ftec) {
                            if( $ftec['ideq'] == $data->ideq ){
                                echo $ftec['ftec'];
                            }
                        }
                        ?>
                    </td>
                    <td id="tbody">
                        <?php
                        foreach ($data->eqfcarg as $fcarg) {
                            if( $fcarg['ideq'] == $data->ideq ){
                                echo $fcarg['fcarg'];
                            }
                        }
                        ?>
                    </td>
                    <td id="tbody">
                        <?php
                        foreach ($data->eqfgen as $fgen) {
                            if( $fgen['ideq'] == $data->ideq ){
                                echo $fgen['fgen'];
                            }
                        }
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php endforeach; ?>
    <page_footer>
        <img id="imgfooter" src="<?php echo Yii::getPathOfAlias('webroot')."/img/printpdf/cintillomppe.jpg" ?>" alt="">
    </page_footer>
</page>
<?php endif;?>
