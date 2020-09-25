<?php

/**
 * This is the model class for table "ciat.fpantalla".
 *
 * The followings are the available columns in table 'ciat.fpantalla':
 * @property integer $idpant
 * @property string $fpant
 * @property integer $ideq
 *
 * The followings are the available model relations:
 * @property Equipo $ideq
 */
class Fpantalla extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sc.fpantalla';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ideq', 'numerical', 'integerOnly'=>true),
			array('fpant', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idpant, fpant, ideq', 'safe', 'on'=>'search'),
		);
	}

	/**
	* @var diagnostico,observacion son purificadas antes de guardar...
	*/
	public function beforeSave() {
		$purifier = new CHtmlPurifier();
		$this->fpant = $purifier->purify($this->fpant);
		return parent::beforeSave();
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'ideq' => array(self::BELONGS_TO, 'Equipo', 'ideq'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idpant' => 'ID',
			'fpant' => 'Falla de pantalla',
			'ideq' => 'Ideq',
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

		$criteria->compare('idpant',$this->idpant);
		$criteria->compare('fpant',$this->fpant,true);
		$criteria->compare('ideq',$this->ideq);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Fpantalla the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
