<?php

/**
 * This is the model class for table "story_activity".
 *
 * The followings are the available columns in table 'story_activity':
 * @property integer $id
 * @property integer $story_id
 * @property string $creation_date
 * @property integer $create_user
 * @property string $comment
 *
 * The followings are the available model relations:
 * @property User $createUser
 * @property Story $story
 */
class StoryActivity extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return StoryActivity the static model class
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
		return 'story_activity';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('story_id, creation_date, create_user', 'required'),
			array('story_id, create_user', 'numerical', 'integerOnly'=>true),
			array('comment', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, story_id, creation_date, create_user, comment', 'safe', 'on'=>'search'),
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
			'createUser' => array(self::BELONGS_TO, 'User', 'create_user'),
			'story' => array(self::BELONGS_TO, 'Story', 'story_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'story_id' => 'Story',
			'creation_date' => 'Creation Date',
			'create_user' => 'Create User',
			'comment' => 'Comment',
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
		$criteria->compare('story_id',$this->story_id);
		$criteria->compare('creation_date',$this->creation_date,true);
		$criteria->compare('create_user',$this->create_user);
		$criteria->compare('comment',$this->comment,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}