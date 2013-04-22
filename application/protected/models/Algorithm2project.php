<?php

/**
 * This is the model class for table "algorithm2project".
 *
 * The followings are the available columns in table 'algorithm2project':
 * @property integer $algorithmId
 * @property integer $projectId
 * @property string $date
 * @property string $output
 */
class Algorithm2project extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Algorithm2project the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'algorithm2project';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('algorithmId, projectId, date, output', 'required'),
			array('algorithmId, projectId', 'numerical', 'integerOnly'=>true),
			array('output', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('algorithmId, projectId, date, output', 'safe', 'on'=>'search'),
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
			'project' => array(self::BELONGS_TO, 'Project', 'projectId'),
			'algorithm' => array(self::BELONGS_TO, 'Algorithm', 'algorithmId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'algorithmId' => 'Algorithm',
			'projectId' => 'Project',
			'date' => 'Date',
			'output' => 'Output',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('algorithmId',$this->algorithmId);
		$criteria->compare('projectId',$this->projectId);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('output',$this->output,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}