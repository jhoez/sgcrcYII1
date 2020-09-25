<?php

/**
 * This is the model class for table "ciat.equipo".
 *
 * The followings are the available columns in table 'ciat.equipo':
 * @property integer $ideq
 * @property string $eqserial
 * @property string $frecepcion
 * @property string $fentrega
 * @property string $eqversion
 * @property string $eqstatus
 * @property integer $idrep
 * @property string $diagnostico
 * @property string $observacion
 *
 * The followings are the available model relations:
 * @property Fpantalla[] $fpantallas
 * @property Fsoftware[] $fsoftwares
 * @property Representante $idrep
 * @property Fcarga[] $fcargas
 * @property Fgeneral[] $fgenerals
 * @property Fteclado[] $fteclados
 * @property Ftarjetamadre[] $ftarjetamadres
 */
class Equipo extends CActiveRecord
{
	public $cedula; // propiedad para filtro CGridView con relaciones
	public $fallas;
	public $mes;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sc.equipo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('eqserial, eqversion, eqstatus, mes, fallas','required'),
			array('eqserial, eqversion, eqstatus','required'),
            array('idrep,  status', 'numerical', 'integerOnly'=>true),
            array('eqserial', 'length', 'max'=>125),
			//array('eqserial', 'match', 'pattern'=> '/[A-Za-z0-9]/', 'message'=> 'tiene que contener unicamente letras y numeros.'),
            array('eqversion', 'length', 'max'=>6),
			//array('status', 'boolean'),
            array('eqstatus', 'length', 'max'=>11),
            array('diagnostico, observacion', 'length', 'max'=>500),
            array('frecepcion, fentrega', 'safe'),
			//array('frecepcion, fentrega', 'type', 'type'=>'date', 'message' => 'No es una fecha!', 'dateFormat' => 'Y-m-d'),//no me funciona
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ideq, eqserial, frecepcion, fentrega, eqversion, eqstatus, idrep, diagnostico, observacion, status, cedula', 'safe', 'on'=>'search'),
        );
	}

	/**
	* @var eqserial,eqversion,eqstatus,diagnostico,observacion son purificadas antes de guardar...
	*/
	public function beforeSave() {
		$purifier = new CHtmlPurifier();
		$this->eqserial		= $purifier->purify($this->eqserial);
		$this->eqversion	= $purifier->purify($this->eqversion);
		$this->eqstatus		= $purifier->purify($this->eqstatus);
		$this->diagnostico	= $purifier->purify($this->diagnostico);
		$this->observacion	= $purifier->purify($this->observacion);
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
			'eqrep'			=> array(self::BELONGS_TO, 'Representante', 'idrep'),
			'eqfsoft'		=> array(self::HAS_MANY, 'Fsoftware', 'ideq'),
			'eqfpant'		=> array(self::HAS_MANY, 'Fpantalla', 'ideq'),
			'eqftarj'		=> array(self::HAS_MANY, 'Ftarjetamadre', 'ideq'),
			'eqftec'		=> array(self::HAS_MANY, 'Fteclado', 'ideq'),
			'eqfcarg'		=> array(self::HAS_MANY, 'Fcarga', 'ideq'),
			'eqfgen'		=> array(self::HAS_MANY, 'Fgeneral', 'ideq'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ideq'			=> 'ID',
			'eqserial'		=> 'Serial del Equipo',
			'frecepcion'	=> 'Fecha recepcion',
			'fentrega'		=> 'Fecha entrega',
			'eqversion'		=> 'Version del Equipo',
			'eqstatus'		=> 'Status del Equipo',
			'idrep'			=> 'Rep',
			'diagnostico'	=> 'Diagnostico del Equipo',
			'observacion'	=> 'Observacion del Equipo',
			'status'		=> 'Status entrega',
			'cedula'		=> 'Cedula',  // propiedad para filtro CGridView con relaciones
			'fallas'		=> 'Reporte de fallas',
			'mes'			=> 'Reporte Mes',
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
		//parse date if necessary
		/*
			$criteria->compare('date_FORMAT( t.frecepcion,\'%d/%m/%Y\' )',$this->frecepcion,true);//PARA MYSQL
			$criteria->compare('to_char( t.frecepcion,\'yyyy-mm-dd\' )',$this->frecepcion,true);//PARA POSTGRESQL
		*/
		$criteria = new CDbCriteria;
		$criteria->with = array('eqrep'=>array('alias'=>'cedrep'));// propiedad para filtro CGridView con relaciones

		$criteria->compare('ideq',$this->ideq);
		$criteria->compare('eqserial',$this->eqserial,true);
		$criteria->compare('frecepcion',$this->frecepcion,false);//false para postgresql o sin parametro boolean si es timestamp
		$criteria->compare('fentrega',$this->fentrega,false);//false para postgresql o sin parametro boolean si es timestamp
		$criteria->compare('eqversion',$this->eqversion,true);
		$criteria->compare('eqstatus',$this->eqstatus,true);

		$criteria->compare('cedrep.cedula',$this->cedula,true); // propiedad para filtro CGridView con relaciones

		$criteria->compare('diagnostico',$this->diagnostico,true);
		$criteria->compare('observacion',$this->observacion,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array("defaultOrder"=>"ideq DESC"),// ORGANIZA REGISTROS DE FORMA DESCENDENTE
			'pagination'=>array('pageSize' => 5 )
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Equipo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

}
