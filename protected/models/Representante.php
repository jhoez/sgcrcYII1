<?php

/**
 * This is the model class for table "ciat.representante".
 *
 * The followings are the available columns in table 'ciat.representante':
 * @property integer $idrep
 * @property string $cedula
 * @property string $nombre
 * @property string $telf
 * @property integer $idciat
 * @property integer $iduser
 * @property string $docente
 * @property integer $idinst
 *
 * The followings are the available model relations:
 * @property Estudiante[] $estudiantes
 * @property Sedeciat $idciat
 * @property Usuarios $iduser
 * @property Insteduc $idinst
 * @property Equipo[] $equipos
 */
class Representante extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sc.representante';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, cedula, telf','required'),

			// CAMBIO PARA VALIDAR CAMPOS ENTEROS EN CGridView
			//array('cedula, telf','required','except'=>'search'),
			//array('cedula,telf','validarCNT', 'on' => 'buscar'),
			//array('cedula, telf', 'numerical', 'integerOnly'=>true, 'except'=>'search'),
			// FIN CAMBIO

			array('idciat, idinst, fkuser, cedula, telf', 'numerical', 'integerOnly'=>true),
            array('cedula', 'length', 'max'=>8),
            array('nombre', 'length', 'max'=>50),
            array('telf', 'length', 'max'=>12),
            array('docente', 'length', 'max'=>1),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('idrep, cedula, nombre, telf, docente, idciat, idinst, fkuser', 'safe', 'on'=>'search'),
		);
	}

	/**
	* ESCENARIO PARA VALIDAR CAMPO NUMERICO BUSCADOS EN CGridView
	* @var cedula
	* @var telf
	*/
	/*
	public function validarCNT($attribute, $params){
		$valor = trim( $attribute );

		if($valor == ""){
			$this->addError($attr, "debe proveer un valor");
		}

		if(!is_numeric($valor)){
			$this->addError($attr, "debe proveer un valor numerico");
		}
	}
	*/

	/**
	* @var diagnostico,observacion son purificadas antes de guardar...
	*/
	public function beforeSave() {
		$purifier = new CHtmlPurifier();
		$this->cedula	= $purifier->purify($this->cedula);
		$this->nombre	= $purifier->purify($this->nombre);
		$this->telf		= $purifier->purify($this->telf);
		$this->docente	= $purifier->purify($this->docente);
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
			'repestu'	=> array(self::HAS_MANY, 'Estudiante', 'idrep'),
			'repdir'	=> array(self::HAS_MANY, 'Direcuser', 'idfkrep'),
			'repeq'		=> array(self::HAS_MANY, 'Equipo', 'idrep'),
            'repciat'	=> array(self::BELONGS_TO, 'Sedeciat', 'idciat'),
            'repinst'	=> array(self::BELONGS_TO, 'Insteduc', 'idinst'),
            'repuser'	=> array(self::BELONGS_TO, 'Usuario', 'fkuser'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idrep' => 'ID',
			'cedula' => 'Cedula',
			'nombre' => 'Representante',
			'telf' => 'Telefono',
			'idciat' => 'ciat',
			'fkuser' => 'Usuario',
			'docente' => 'Docente',
			'idinst' => 'inst',
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

		$criteria->compare('idrep',$this->idrep);
        $criteria->compare('cedula',$this->cedula,true);
        $criteria->compare('nombre',$this->nombre,true);
        $criteria->compare('telf',$this->telf,true);
        $criteria->compare('docente',$this->docente,true);
        $criteria->compare('idciat',$this->idciat);
        $criteria->compare('idinst',$this->idinst);
		$criteria->compare('fkuser',$this->fkuser);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Representante the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
