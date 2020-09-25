<?php

/**
 * This is the model class for table "sgci.multimedia".
 *
 * The followings are the available columns in table 'sgci.multimedia':
 * @property integer $idmult
 * @property string $nombmult
 * @property string $extension
 * @property string $tipomult
 * @property string $ruta
 * @property integer $fkidpro
 *
 * The followings are the available model relations:
 * @property Proyecto $fkidpro
 */
class Multimedia extends CActiveRecord
{
	public $nombpro;
	public $creador;
	public $mva;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sc.multimedia';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mva','required'),
			array('fkidpro', 'numerical', 'integerOnly'=>true),
			array('nombmult, ruta', 'length', 'max'=>255),
			array('extension, tipomult', 'length', 'max'=>5),
			array('tamanio', 'length', 'max'=>20),
			array('mva','file',
						'allowEmpty'=>true,
						'types'=>'mp4,mp3',
						//'on' => 'validarVideo', // scenario
						//'except'=>'update',
						//'message' => 'Extensión de archivo valido!',  // Error message
						//'wrongType'=> 'Extensión de archivo invalido!',
						//'minSize'=>1024,// 1MB
						//'maxSize'=>1024,
						//'maxFiles'=>4,
						//'tooLarge'=>'File Size Too Large',//Error Message
						//'tooSmall'=>'File Size Too Small',//Error Message
						//'tooMany'=>'Too Many Files Uploaded',//Error Message
			),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idmult, nombmult, extension, tipomult, tamanio, ruta, fkidpro, nombpro, creador', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'multpro' => array(self::BELONGS_TO, 'Proyecto', 'fkidpro'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idmult' => 'ID',
			'nombmult' => 'Nombre Archivo',
			'extension' => 'Extension',
			'tipomult' => 'Tipo de archivo',
			'tamanio' => 'Tamaño del archivo',
			'ruta' => 'Ruta',
			'mva' => 'Archivo multimedia a subir',
			'fkidpro' => 'proyecto'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->with = array('multpro'=>array('alias'=>'proy'));

		$criteria->compare('idmult',$this->idmult);
		$criteria->compare('nombmult',$this->nombmult,true);
		$criteria->compare('extension',$this->extension,true);
		$criteria->compare('tipomult',$this->tipomult,true);
		$criteria->compare('tamanio',$this->tamanio,true);
		$criteria->compare('ruta',$this->ruta,true);
		$criteria->compare('fkidpro',$this->fkidpro);

		$criteria->compare('proy.nombpro',$this->nombpro,true);
		$criteria->compare('proy.creador',$this->creador,true);// obtengo el nombre del proyecto por la relacion

		if (
			Yii::app()->user->checkAccess('admin') ||
			Yii::app()->user->checkAccess('administrador') ||
			Yii::app()->user->checkAccess('tutor')
		) {
			$usuario = Usuario::model()->findByPk(Yii::app()->user->id);
			$criteria->compare('proy.fkuser',$usuario->iduser);
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array('defaultOrder'=>'idmult DESC'),
			'pagination'=>array('pageSize' => 5 )
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Multimedia the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
