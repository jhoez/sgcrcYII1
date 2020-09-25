<?php

/**
 * This is the model class for table "sc.cruge_user".
 *
 * The followings are the available columns in table 'sc.cruge_user':
 * @property integer $iduser
 * @property string $username
 * @property string $email
 * @property string $cedula
 * @property string $cbit
 *
 */
class Usuario extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sc.cruge_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('state', 'numerical', 'integerOnly'=>true),
			//array('username, password', 'length', 'max'=>64),
			//array('email', 'length', 'max'=>45),
			//array('cedula', 'length', 'max'=>10),
			//array('cbit', 'length', 'max'=>255),
			//array('authkey', 'length', 'max'=>100),
			//array('regdate, actdate, logondate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			//array('iduser, username, email, cedula, cbit, password, state', 'safe', 'on'=>'search'),
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
			//'crugeFieldvalues' => array(self::HAS_MANY, 'CrugeFieldvalue', 'iduser'),
			//'sc.crugeAuthitems' => array(self::MANY_MANY, 'CrugeAuthitem', 'cruge_authassignment(userid, itemname)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'iduser' => 'Id',
			'username' => 'Usuario',
			'email' => 'Email',
			'cedula' => 'Cedula',
			'cbit' => 'Cbit',
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

		$criteria->compare('iduser',$this->iduser);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('cedula',$this->cedula,true);
		$criteria->compare('cbit',$this->cbit,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CrugeUserModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
