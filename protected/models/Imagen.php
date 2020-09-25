<?php

/**
 * This is the model class for table "sgci.imagen".
 *
 * The followings are the available columns in table 'sgci.imagen':
 * @property integer $idimag
 * @property string $nombimg
 * @property string $extension
 * @property string $ruta
 * @property string $tamanio
 * @property integer $idfklib
 *
 * The followings are the available model relations:
 * @property Libros $idfklib
 */
class Imagen extends CActiveRecord
{
	public $imagen;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sc.imagen';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('imagen','required'),
			array('fkuser', 'numerical', 'integerOnly'=>true),
			array('nombimg, tamanio', 'length', 'max'=>50),
			array('extension', 'length', 'max'=>5),
			array('ruta', 'length', 'max'=>255),
			array('tipoimg', 'length', 'max'=>7),
			array('imagen','file',
							'allowEmpty'=>true,
							'types'=>'png',
							//'on' => 'validarPNG',
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
			array('idimag, nombimg, extension, ruta, tamanio, tipoimg, fkuser', 'safe', 'on'=>'search'),
		);
	}

	public function validarPNG($attributes, $param){
		if ($this->imagen->getExtensionName() != 'png') {
			$this->addError('imagen','La imagen deber ser PNG');
		}
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'imglib' => array(self::HAS_MANY, 'Libros', 'idfkimag'),
			'imgra' => array(self::HAS_MANY, 'Realaum', 'fkimag'),
			'imguser' => array(self::BELONGS_TO, 'Usuario', 'fkuser'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idimag'	=> 'Id',
			'nombimg'	=> 'Nombre imagen',
			'extension' => 'Extension',
			'ruta'		=> 'Ruta',
			'tamanio'	=> 'Tamanio',
			'tipoimg'	=> 'Tipoimg',
			'imagen'	=> 'Imagen',
			'fkuser'	=> 'Fkuser',
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

		$criteria->compare('idimag',$this->idimag);
		$criteria->compare('nombimg',$this->nombimg,true);
		$criteria->compare('extension',$this->extension,true);
		$criteria->compare('ruta',$this->ruta,true);
		$criteria->compare('tamanio',$this->tamanio,true);
		$criteria->compare('tipoimg',$this->tipoimg,true);
		$criteria->compare('fkuser',$this->fkuser);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array('defaultOrder'=>'idimag DESC'),
			'pagination'=>array('pageSize' => 5 )
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Imagen the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
