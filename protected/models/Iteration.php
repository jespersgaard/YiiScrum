<?php

/**
 * This is the model class for table "iteration".
 *
 * The followings are the available columns in table 'iteration':
 * @property integer $id
 * @property integer $num
 * @property integer $team_strength
 *
 * The followings are the available model relations:
 * @property Story[] $stories
 */
class Iteration extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Iteration the static model class
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
		return 'iteration';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('num, team_strength', 'required'),
			array('num, team_strength', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, num, team_strength', 'safe', 'on'=>'search'),
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
			'stories' => array(self::HAS_MANY, 'Story', 'iteration'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'num' => 'Num',
			'team_strength' => 'Team Strength',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('num',$this->num);
		$criteria->compare('team_strength',$this->team_strength);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}