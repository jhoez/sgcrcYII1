<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	//variables para la asistencia marcan la hora de entrada y salida del tutor
	public $horaE = '01:00:00';
	public $horaS = '01:20:00';

	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	/*
     * Antes de que se ejecute una acción
     */
	//protected function updateExpirationSession($action = '') {
	public function beforeAction($action){
        // Cada vez que se ejecuta una acción se actualiza el tiempo de expiración
        // TODO: integrar con cruge o mejorar
        $sys = Yii::app()->user->um->getDefaultSystem();
        $duration = $sys->getn('sessionmaxdurationmins');
        // Encuentra la última sesión y actualiza la fecha de expiración
        $model = CrugeSession::model()->findLast(Yii::app()->user->id);
        if ($model != null) {
            $model->expire = CrugeUtil::makeExpirationDateTime($duration);
            $model->save();
        }
        return true;
    }

	/**
	*	https://wiki.ubuntu.com/UnitsPolicy
	*	convertidor formato byte
	*/
	public function convert_format_bytes($bytes, $precision = 2) {
		$units = array('B', 'KB', 'MB', 'GB');
		$bytes = max($bytes, 0);
		$pow = floor(($bytes ? log($bytes) : 0) / log(1000));
		$pow = min($pow, count($units) - 1);
		$bytes /= pow(1000, $pow);
		return round($bytes, $precision) . ' ' . $units[$pow];
	}

	/**
	*	@method eliminarArchivo
	*	se utilizara para eliminar los archivos de los siguientes modulos
	*	evitando mostrar algun error con @unlink()
	*	CONTENIDO EDUCATIVO
	*	PROYECTOS DIGITALES
	*	REALIDAD AUMENTADA
	*	TUTORES
	*/
	public function eliminarArchivo($ruta = NULL, $archivo = null){
		if(is_dir($ruta))
		{
			if(file_exists($ruta.$archivo))
			{
				$result = @unlink($ruta.$archivo);
			}else {
				throw new CHttpException('No existe el archivo.');
			}
		}else {
			throw new CHttpException('El directorio no existe.');
		}
		return $result;
	}
}
