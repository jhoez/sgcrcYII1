<?php
/* @var $this EquipoController */
/* @var $model Equipo */

$this->breadcrumbs=array(
    'Equipos'=>array('index'),
    $equipo->ideq,
);

if(Yii::app()->user->checkAccess('tutor')){
    $this->menu=array(
        array('label'=>"<i class='small material-icons right'>home</i>", 'url'=>array('index'),'linkOptions'=>array('class'=>'btn-floating')),
    );
}

if (Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador')) {
    $this->menu=array(
        array('label'=>"<i class='small material-icons right'>home</i>", 'url'=>array('index'),'linkOptions'=>array('class'=>'btn-floating blue')),
    );
}
?>


<h4 class="center-align">Detalle del Equipo: Serial(<?php echo $equipo->eqserial; ?>)</h4>
<div class="row">
    <div class="col s12">
        <!-- primera fila -->
    	<table class="centered" cellpadding="7">
    		<thead>
    			<tr>
    				<th>ID</th>
    				<th>CIAT</th>
    				<th>Institución</th>
    				<th>Representante</th>
    				<th>Cedula</th>
    				<th>Docente</th>
    				<th>Telefono</th>
    			</tr>
    		</thead>
    		<tbody>
    			<tr>
    				<td><?=$equipo->ideq;?></td>
    				<td><?=$equipo->eqrep->repciat->sede;?></td>
    				<td><?=$equipo->eqrep->repinst->nombinst;?></td>
    				<td><?=$equipo->eqrep->nombre;?></td>
    				<td><?=$equipo->eqrep->cedula;?></td>
    				<td><?=$valor = $equipo->eqrep->docente == 'true' ? 'Maestro' : 'No';?></td>
    				<td><?=$equipo->eqrep->telf;?></td>
    			</tr>
    		</tbody>
    	</table>

        <br><br>

        <table class="centered" cellpadding="7">
    		<!-- segunda fila -->
    		<thead>
    			<tr>
    				<th>Estudiante</th>
    				<th>Grado</th>
    				<th>Graduado</th>
    				<th>Equipo</th>
    				<th>Serial equipo</th>
    				<th>Status</th>
    				<th>Diagnostico</th>
    			</tr>
    		</thead>
    		<tbody>
    			<tr>
    				<td>
    					<?php
    					foreach ($equipo->eqrep->repestu as $value) {
    						if( $value['idrep'] == $equipo->eqrep->idrep ){
    							echo $value['nombestu'];
    						}
    					}
    					?>
    				</td>
    				<td>
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
    				<td>
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
    				<td><?=$equipo->eqversion;?></td>
    				<td><?=$equipo->eqserial;?></td>
    				<td><?=$equipo->eqstatus;?></td>
    				<td><?=$equipo->diagnostico;?></td>
    			</tr>
    		</tbody>
    	</table>

        <br><br>

        <table class="centered" cellpadding="7">
    		<!-- tercera fila -->
    		<thead>
    			<tr>
    				<th>Observacion</th>
    				<th>F software</th>
    				<th>F pantalla</th>
    				<th>F tarjeta madre</th>
    				<th>F teclado</th>
    				<th>F carga</th>
    				<th>F general</th>
    			</tr>
    		</thead>
    		<tbody>
    			<tr>
    				<td><?=$equipo->observacion;?></td>
    				<td>
    					<?php
    					foreach ($equipo->eqfsoft as $fsoft) {
    						if( $fsoft['ideq'] == $equipo->ideq ){
    							echo $fsoft['fsoft'];
    						}
    					}
    					?>
    				</td>
    				<td>
    					<?php
    					foreach ($equipo->eqfpant as $fpant) {
    						if( $fpant['ideq'] == $equipo->ideq ){
    							echo $fpant['fpant'];
    						}
    					}
    					?>
    				</td>
    				<td>
    					<?php
    					foreach ($equipo->eqftarj as $ftarj) {
    						if( $ftarj['ideq'] == $equipo->ideq ){
    							echo $ftarj['ftarj'];
    						}
    					}
    					?>
    				</td>
    				<td>
    					<?php
    					foreach ($equipo->eqftec as $ftec) {
    						if( $ftec['ideq'] == $equipo->ideq ){
    							echo $ftec['ftec'];
    						}
    					}
    					?>
    				</td>
    				<td>
    					<?php
    					foreach ($equipo->eqfcarg as $fcarg) {
    						if( $fcarg['ideq'] == $equipo->ideq ){
    							echo $fcarg['fcarg'];
    						}
    					}
    					?>
    				</td>
    				<td>
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
</div>

<div class="row">
    <div class="center-align">
        <?php
        $image = CHtml::image(
            Yii::app()->request->baseUrl.'/fonts/left2.svg',
            'left',
            array('id'=>'regresar','width'=>'35px','title'=>'regresar','class'=>'arrow-left')
        );
        echo CHtml::link( $image, array("/equipo/index") );
        ?>
    </div>
</div>


<script type="text/javascript">
	<?php if(Yii::app()->user->hasFlash('canaimitaC')){ ?>
		window.addEventListener('load', function(){
			Swal.fire({
				icon: 'success',
				title: "<?php echo Yii::app()->user->getFlash('canaimitaC')?>",
				showConfirmButton: false,
				timer: 2000 // es ms (mili-segundos)
			});
		});
	<?php } ?>
</script>
