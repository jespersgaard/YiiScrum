<?php

/**
 * This is the model class for table "project".
 *
 * The followings are the available columns in table 'project':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $start
 * @property integer $iteration_length
 * @property integer $initial_velocity
 * @property string $create_time
 *
 * The followings are the available model relations:
 * @property ProjectMember[] $projectMembers
 */
class Project extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Project the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'project';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, start', 'required'),
            array('iteration_length, initial_velocity', 'numerical', 'integerOnly' => true),
            array('title', 'length', 'max' => 200),
            array('description', 'safe'),
            array('create_time', 'default', 'value' => new CDbExpression('NOW()'),
                'on' => 'insert'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, title, description, start, iteration_length, initial_velocity, create_time', 'safe', 'on' => 'search'),
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
            'projectMembers' => array(self::HAS_MANY, 'ProjectMember', 'project_id'),
            'stories' => array(self::HAS_MANY, 'Story', 'project_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'start' => 'Start',
            'iteration_length' => 'Iteration Length',
            'initial_velocity' => 'Initial Velocity',
            'create_time' => 'Create Time',
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

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('start', $this->start, true);
        $criteria->compare('iteration_length', $this->iteration_length);
        $criteria->compare('initial_velocity', $this->initial_velocity);
        $criteria->compare('create_time', $this->create_time, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getProjectUsersLabels()
    {
        $ret = array();
        $members = $this->projectMembers;
        foreach ($members as $member) {
            $ret[$member->user_id] = $member->user->username;
        }
        return $ret;
    }

    public function getNonProjectUsersLabels()
    {
        $ret = array();

        $q = 'SELECT user.id, user.username FROM  user
              LEFT JOIN project_member AS pm ON (user.id=pm.user_id AND pm.project_id=:project_id1)
              WHERE pm.user_id IS NULL';
        $cmd = Yii::app()->db->createCommand($q);
        $project_id1=$this->id;
        $cmd->bindParam(':project_id1', $project_id1, PDO::PARAM_INT);

        $result = $cmd->query();

        foreach ($result as $user) {
            $ret[$user["id"]] = $user["username"];
        }
        return $ret;
    }

    protected function afterSave()
    {
        if ($this->isNewRecord) {
            $projectMember = new ProjectMember();
            $projectMember->project_id = $this->id;
            $projectMember->user_id = Yii::app()->user->id;
            $projectMember->role = "OWNER";
            $projectMember->save();
        }
        parent::afterSave();
    }

    public static function getRoleOptions()
    {
        return array(
            'OWNER' => 'Owner',
            'MEMBER' => 'Member',
            'VIEWER' => 'Viewer',

        );
    }

}