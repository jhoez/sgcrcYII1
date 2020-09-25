<?php

/**
 * This is the model class for table "sgci.proyecto".
 *
 * The followings are the available columns in table 'sgci.proyecto':
 * @property integer $idpro
 * @property string $nombpro
 * @property string $creador
 * @property string $colabocion
 * @property string $descripcion
 * @property string $create_at
 *
 * The followings are the available model relations:
 * @property Multimedia[] $multimedias
 */
class Proyecto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sc.proyecto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombpro, creador','required'),
			array('fkuser', 'numerical', 'integerOnly'=>true),
			array('nombpro, colaboracion', 'length', 'max'=>255),
			array('descripcion', 'length', 'max'=>500),
			array('creador', 'length', 'max'=>50),
			array('create_at, update_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idpro, nombpro, creador, colaboracion, descripcion, create_at, update_at, fkuser', 'safe', 'on'=>'search'),
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
			'proavm' => array(self::HAS_MANY, 'Multimedia', 'fkidpro'),
			'prora' => array(self::HAS_MANY, 'Realaum', 'fk_pro'),
			'prouser' => array(self::BELONGS_TO, 'Usuario', 'fkuser'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idpro' => 'ID',
			'nombpro' => 'Nombre del proyecto',
			'creador' => 'Centro Bolivariano de Informatica y Telematica',
			'colaboracion' => 'Colaboración',
			'descripcion' => 'Descripción',
			'create_at' => 'F Creación',
			'update_at' => 'F Modificado',
			'fkuser' => 'Usuario'
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

		$criteria->compare('idpro',$this->idpro);
		$criteria->compare('nombpro',$this->nombpro,true);
		$criteria->compare('creador',$this->creador,true);
		$criteria->compare('colaboracion',$this->colaboracion,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('create_at',$this->create_at,true);
		$criteria->compare('update_at',$this->update_at,true);
		$criteria->compare('fkuser',$this->fkuser);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array('defaultOrder'=>'idpro DESC'),
			'pagination'=>array('pageSize' => 5 )
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Proyecto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
