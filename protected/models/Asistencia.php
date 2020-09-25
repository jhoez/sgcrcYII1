<?php

/**
 * This is the model class for table "sc.asistencia".
 *
 * The followings are the available columns in table 'sc.asistencia':
 * @property integer $idasis
 * @property integer $fkuser
 * @property string $fecha
 * @property string $horain
 * @property string $horaout
 *
 * The followings are the available model relations:
 * @property Usuarios $fkuser
 */
class Asistencia extends CActiveRecord
{
	public $getName;
	public $fechain;
	public $fechaout;
	public $mes;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sc.asistencia';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('mes','required'),
			array('fkuser', 'numerical', 'integerOnly'=>true),
			array('observacion', 'length', 'max'=>500),
			array('fecha, horain, horaout', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('idasis, fkuser, fecha, horain, horaout, observacion', 'safe', 'on'=>'search'),
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
			'asisuser' => array(self::BELONGS_TO, 'Usuario', 'fkuser'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idasis' => 'Idasis',
			//'fkuser' => 'Fkuser',
			'fecha' => 'Fecha',
			'horain' => 'Hora Entrada',
            'horaout' => 'Hora Salida',
            'observacion' => 'Observacion',
			'fechain'=>'Fecha inicio',
			'fechaout'=>'Fecha fin',
			'mes'=>'Reporte Mensual'
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

		$criteria->compare('idasis',$this->idasis);
		$criteria->compare('fkuser',$this->fkuser);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('horain',$this->horain,true);
        $criteria->compare('horaout',$this->horaout,true);
        $criteria->compare('observacion',$this->observacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array("defaultOrder"=>"idasis DESC"),// ORGANIZA REGISTROS DE FORMA DESCENDENTE
			'pagination'=>array('pageSize' => 5 )
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Asistencia the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
