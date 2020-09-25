<?php

/**
 * This is the model class for table "sgci.realaum".
 *
 * The followings are the available columns in table 'sgci.realaum':
 * @property integer $idra
 * @property string $nra
 * @property string $exten
 * @property string $ruta
 * @property integer $fk_pro
 *
 * The followings are the available model relations:
 * @property Proyecto $fk_pro
 */
class Realaum extends CActiveRecord
{
	public $creador;
	public $nombpro;
	public $raimg;// imagen de RA
	public $fileglb;// archivo GLB
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sc.realaum';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fileglb', 'required'),
			array('fk_pro, fkimag', 'numerical', 'integerOnly'=>true),
			array('nra, ruta', 'length', 'max'=>255),
			array('exten', 'length', 'max'=>5),
			array('fileglb',
						'file',
						'allowEmpty'=>true,
						'types'=>'glb',
			),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idra, nra, exten, ruta, fk_pro, fkimag, nombpro, creador', 'safe', 'on'=>'search'),
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
			'rapro' => array(self::BELONGS_TO, 'Proyecto', 'fk_pro'),
			'raimag' => array(self::BELONGS_TO, 'Imagen', 'fkimag'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idra' => 'Idra',
			'nra' => 'Nra',
			'exten' => 'Exten',
			'ruta' => 'Ruta',
			'fk_pro' => 'fk_pro',
			'fkimag' => 'Fkimag',
			'fileglb' => 'Patron de Realidad Aumentada',
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
		$criteria->with = array('rapro'=>array('alias'=>'proy'));

		$criteria->compare('idra',$this->idra);
		$criteria->compare('nra',$this->nra,true);
		$criteria->compare('exten',$this->exten,true);
		$criteria->compare('ruta',$this->ruta,true);
		$criteria->compare('fk_pro',$this->fk_pro);
		$criteria->compare('fkimag',$this->fkimag);

		$criteria->compare('proy.creador',$this->creador,true);
		$criteria->compare('proy.nombpro',$this->nombpro,true);

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
			'sort'=>array('defaultOrder'=>'idra DESC'),
			'pagination'=>array('pageSize' => 5 )
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Realaum the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
