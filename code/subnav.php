<div class="col s12">
    <ul id="slide-out" class="sidenav">
        <li>
            <div class="user-view">
                <div class="background">
                    <?php
            		echo CHtml::image(Yii::app()->baseUrl."/img/r3.png", 'user');
            		?>
                </div>
                <a href="#user">
                    <?php
            		echo CHtml::image(Yii::app()->baseUrl."/img/logo.jpg", 'user', array('class' => 'circle'));
            		?>
                </a>
                <a href="#name"><span class="white-text name"><?php echo Yii::app()->user->name; ?></span></a>
                <a href="#email"><span class="white-text email"><?php echo Yii::app()->user->email; ?></span></a>
            </div>
        </li>
        <li><a class="subheader">Menu Acciones</a></li>
        <li><div class="divider"></div></li>
        <li><?php echo CHtml::link("<i class='small material-icons'>add</i>Registrar Canaimitas",array('equipo/create'),array('class'=>'waves-effect')); ?></li>
        <li><?php echo CHtml::link("<i class='small material-icons'>assignment</i>Reporte Canaimitas",array('equipo/reportespdf'),array('class'=>'waves-effect')); ?></li>
        <li><?php echo CHtml::link("<i class='small material-icons'>attach_file</i>Subir Formato",array('equipo/createf'),array('class'=>'waves-effect')); ?></li>
    </ul>
    <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="small material-icons">menu</i>acciones</a>
</div>
