<?php

/**
 * This is the model class for table "ciat.fgeneral".
 *
 * The followings are the available columns in table 'ciat.fgeneral':
 * @property integer $idgen
 * @property string $fgen
 * @property integer $ideq
 *
 * The followings are the available model relations:
 * @property Equipo $ideq
 */
class Fgeneral extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sc.fgeneral';
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
			array('fgen', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idgen, fgen, ideq', 'safe', 'on'=>'search'),
		);
	}

	/**
	* @var diagnostico,observacion son purificadas antes de guardar...
	*/
	public function beforeSave() {
		$purifier = new CHtmlPurifier();
		$this->fgen = $purifier->purify($this->fgen);
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
			'idgen' => 'ID',
			'fgen' => 'Falla general',
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

		$criteria->compare('idgen',$this->idgen);
		$criteria->compare('fgen',$this->fgen,true);
		$criteria->compare('ideq',$this->ideq);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Fgeneral the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
