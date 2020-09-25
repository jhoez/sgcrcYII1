<?php if($asistencia !== null):?>
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

    #cuerpo {
        clear: both;
    }

    .fecha {
        text-align:right;
        margin-right: 20px;
        margin-bottom:15px;
    }
    #titlereport{
        margin:0px auto;
        text-align:center;
        margin-bottom:10px;
    }

    #cuerpo {
        background: #123;
        width: 491px;
        height:940px;
        max-height: 940px;
        margin:0px 151.5px;
    }
    .items{
        border-collapse: collapse;
    }
    thead tr th {
        color: #fff;
        background-color: #a70139;
        width:98.2px;
        /*max-width: 98.2px;*/
        padding:5px 0px;
        font-size:12px;
        vertical-align: middle;
        text-align: center;
    }
    tbody tr td {
        background-color: #cdcdcd;
        font-size:10px;
        width:98.2px;
        /*max-width: 98.2px;*/
        padding:5px 0px;
        vertical-align: middle;
        text-align:center;
    }
</style>

<!--<page  backcolor="#FEFEFE" backimg="<?php //echo Yii::getPathOfAlias('webroot')."/img/printpdf/bannerfundabit.jpg" ?>" backimgx="center" backimgy="top" backimgw="100%" backtop="0" backbottom="30mm" footer="date;page" style="font-size: 16px">-->
<page backtop="15" backbottom="15" backleft="0" backright="0">
    <bookmark title="Reporte asistencia" level="0" ></bookmark>
    <page_header background="#199">
        <img id="imgheader" src="<?php echo Yii::getPathOfAlias('webroot')."/img/printpdf/bannerfundabit.jpg" ?>" alt="">
    </page_header>

    <div class="fecha"><b>Reporte Fecha: </b><?=date("d/m/Y");?></div>
    <div id="titlereport">
        <?php if (isset($finicio) && isset($ffin)) {
            echo "<h4>Reporte de Asistencia desde ".$finicio." hasta ".$ffin."</h4>";
        }else if(!empty($mes)){
            setlocale(LC_TIME, 'es_ES.UTF-8');
            $fecha = DateTime::createFromFormat('!m',$mes);
            echo "<h4>Reporte de Asistencia de ".ucwords((string)strftime("%B",(int)$fecha->getTimestamp()))."</h4>";
        }?>
    </div>
    <div id="cuerpo">
        <table class="items">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Fecha</th>
                    <th>Hora de Entrada</th>
                    <th>Hora de Salida</th>
                    <th>Observacion</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($asistencia as $value) {?>
                    <tr>
                        <td><?=$value->asisuser->nomb; ?></td>
                        <td><?=$value->fecha; ?></td>
                        <td><?=$value->horain; ?></td>
                        <td><?=$value->horaout; ?></td>
                        <td><?=$value->observacion; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <page_footer>
        <img id="imgfooter" src="<?php echo Yii::getPathOfAlias('webroot')."/img/printpdf/cintillomppe.jpg" ?>" alt="">
    </page_footer>
</page>
<!--<page backimg="<?php //echo Yii::getPathOfAlias('webroot')."/img/printpdf/cintillomppe.jpg" ?>" backimgx="center" backimgy="bottom" backimgw="100%" backtop="100" backbottom="30mm"></page>-->
<?php endif;?>
