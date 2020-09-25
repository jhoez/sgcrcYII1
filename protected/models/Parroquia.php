<?php

/**
 * This is the model class for table "sgci.parroquia".
 *
 * The followings are the available columns in table 'sgci.parroquia':
 * @property integer $idpar
 * @property string $parroquia
 * @property integer $idmunc
 *
 * The followings are the available model relations:
 * @property Municipio $idmunc
 */
class Parroquia extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sc.parroquia';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idpar','required'),
			array('idmunc', 'numerical', 'integerOnly'=>true),
			array('parroquia', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idpar, parroquia, idmunc', 'safe', 'on'=>'search'),
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
			'munic' => array(self::BELONGS_TO, 'Municipio', 'idmunc'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idpar' => 'Parroquia',
			'parroquia' => 'Parroquia',
			'idmunc' => 'Idmunc',
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

		$criteria->compare('idpar',$this->idpar);
		$criteria->compare('parroquia',$this->parroquia,true);
		$criteria->compare('idmunc',$this->idmunc);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Parroquia the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
