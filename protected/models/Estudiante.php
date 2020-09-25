<?php

/**
 * This is the model class for table "ciat.estudiante".
 *
 * The followings are the available columns in table 'ciat.estudiante':
 * @property integer $idestu
 * @property string $nombestu
 * @property integer $idinst
 * @property integer $idrep
 *
 * The followings are the available model relations:
 * @property Representante $idrep
 * @property Insteduc $idinst
 * @property Niveleduc[] $niveleducs
 */
class Estudiante extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sc.estudiante';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idinst, idrep', 'numerical', 'integerOnly'=>true),
			array('nombestu', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idestu, nombestu, idrep, idinst', 'safe', 'on'=>'search'),
		);
	}

	/**
	* @var diagnostico,observacion son purificadas antes de guardar...
	*/
	public function beforeSave() {
		$purifier = new CHtmlPurifier();
		$this->nombestu = $purifier->purify($this->nombestu);
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
			'representestu' => array(self::BELONGS_TO, 'Representante', 'idrep'),
			'reginst' => array(self::BELONGS_TO, 'Insteduc', 'idinst'),
			'niveduc' => array(self::HAS_MANY, 'Niveleduc', 'idestu'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idestu' => 'ID',
			'nombestu' => 'Nombre Estudiante',
			'idinst' => 'Inst',
			'idrep' => 'Rep',
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

		$criteria->compare('idestu',$this->idestu);
		$criteria->compare('nombestu',$this->nombestu,true);
		$criteria->compare('idrep',$this->idrep);
		$criteria->compare('idinst',$this->idinst);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Estudiante the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
