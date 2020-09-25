<?php

/**
 * This is the model class for table "sgci.libros".
 *
 * The followings are the available columns in table 'sgci.libros':
 * @property integer $idlib
 * @property string $nomblib
 * @property string $extension
 * @property string $ruta
 * @property string $coleccion
 */
class Libros extends CActiveRecord
{
	public $files;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sc.libros';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('coleccion','filter','filter'=>array($obj=new CHtmlPurifier(),'purify')), // se puede purificar en rules
			array('coleccion, files', 'required'),
			array('idfkimag', 'numerical', 'integerOnly'=>true),
			array('nomblib, ruta', 'length', 'max'=>255),
			array('extension', 'length', 'max'=>5),
			array('coleccion, tamanio', 'length', 'max'=>255),
			array('nivel', 'length', 'max'=>11),
			array('files','file',
						'allowEmpty'=>true,
						'types'=>'pdf',
						//'on' => 'validarPDF',
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
			array('idlib, nomblib, extension, ruta, coleccion, nivel, tamanio, idfkimag', 'safe', 'on'=>'search'),
		);
	}

	/**
	* @method ESCENARIO validarPDF
	* valida si la extension es pdf
	*/
	public function validarPDF($atributo, $parametros){
		//$this->addError('files', "Extensión de archivo invalido solo se aceptan archivos pdf". ($this->files));
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'libimg' => array(self::BELONGS_TO, 'Imagen', 'idfkimag'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idlib' => 'Idlib',
			'nomblib' => 'Nomblib',
			'extension' => 'Extension',
			'ruta' => 'Ruta',
			'coleccion' => 'Coleccion',
			'nivel' => 'Nivel Educativo',
			'tamanio' => 'Size',
			'idfkimag' => 'Imagen',
			'files' => 'Archivo a subir'
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

		$criteria->compare('idlib',$this->idlib);
		$criteria->compare('nomblib',$this->nomblib,true);
		$criteria->compare('extension',$this->extension,true);
		$criteria->compare('ruta',$this->ruta,true);
		$criteria->compare('coleccion',$this->coleccion,true);
		$criteria->compare('nivel',$this->nivel,true);
		$criteria->compare('tamanio',$this->tamanio,true);
		$criteria->compare('idfkimag',$this->idfkimag);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array("defaultOrder"=>"idlib DESC"),// ORGANIZA REGISTROS DE FORMA DESCENDENTE
			'pagination'=>array('pageSize' => 5 )
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Libros the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
