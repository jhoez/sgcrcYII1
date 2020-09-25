<?php

/**
 * This is the model class for table "ciat.niveleduc".
 *
 * The followings are the available columns in table 'ciat.niveleduc':
 * @property integer $idniv
 * @property string $nivel
 * @property string $graduado
 * @property integer $idestu
 *
 * The followings are the available model relations:
 * @property Estudiante $idestu
 */
class Niveleduc extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sc.niveleduc';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nivel', 'required'),
			array('idestu', 'numerical', 'integerOnly'=>true),
			array('nivel', 'length', 'max'=>20),
			array('graduado', 'boolean'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idniv, nivel, graduado, idestu', 'safe', 'on'=>'search'),
		);
	}

	/**
	* @var diagnostico,observacion son purificadas antes de guardar...
	*/
	public function beforeSave() {
		$purifier = new CHtmlPurifier();
		$this->nivel = $purifier->purify($this->nivel);
		$this->graduado = $purifier->purify($this->graduado);
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
			'idestu' => array(self::BELONGS_TO, 'Estudiante', 'idestu'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idniv' => 'ID',
			'nivel' => 'Nivel educativo',
			'graduado' => 'Graduado',
			'idestu' => 'Idestu',
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

		$criteria->compare('idniv',$this->idniv);
		$criteria->compare('nivel',$this->nivel,true);
		$criteria->compare('graduado',$this->graduado,true);
		$criteria->compare('idestu',$this->idestu);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Niveleduc the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
