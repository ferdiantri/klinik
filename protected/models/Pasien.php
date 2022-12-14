<?php

/**
 * This is the model class for table "pasien".
 *
 * The followings are the available columns in table 'pasien':
 * @property integer $id
 * @property string $tanggal
 * @property string $nama
 * @property integer $id_wilayah
 * @property string $alamat
 * @property string $jenis_kelamin
 * @property integer $umur
 * @property string $keluhan
 * @property string $status
 */
class Pasien extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pasien';
	}
	

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tanggal', 'length', 'max'=>20),
			array('nama, alamat, jenis_kelamin, umur, keluhan', 'required'),
			array('id_wilayah', 'length', 'max'=>10),
			array('umur', 'numerical', 'integerOnly'=>true),
			array('nama, alamat, jenis_kelamin', 'length', 'max'=>1000),
			array('keluhan', 'length', 'max'=>300),
			array('status', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, tanggal,nama, alamat, jenis_kelamin, umur, keluhan, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	// public function relations()
	// {
	// 	// NOTE: you may need to adjust the relation name and the related
	// 	// class name for the relations automatically generated below.
	// 	return array(
	// 	);
	// }
	public function relations()
    {
        return array(
            'pasien'=>array(
                self::HAS_MANY,'Pasien','id','joinType'=>'INNER JOIN'
            ),
            'tindakan'=>array(
                self::HAS_MANY,'Tindakan',array('id_pasien'=>'id'), 'joinType'=>'INNER JOIN'
            ),
        );
    }
	

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'tanggal' => 'Tanggal',
			'nama' => 'Nama',
			'id_wilayah' => 'Id Wilayah',
			'alamat' => 'Alamat',
			'jenis_kelamin' => 'Jenis Kelamin',
			'umur' => 'Umur',
			'keluhan' => 'Keluhan',
			'status' => 'Status',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('tanggal',$this->tanggal);
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('id_wilayah',$this->id_wilayah);
		$criteria->compare('alamat',$this->alamat,true);
		$criteria->compare('jenis_kelamin',$this->jenis_kelamin,true);
		$criteria->compare('umur',$this->umur);
		$criteria->compare('keluhan',$this->keluhan,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pasien the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
