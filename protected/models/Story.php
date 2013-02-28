<?php

/**
 * This is the model class for table "story".
 *
 * The followings are the available columns in table 'story':
 * @property integer $id
 * @property integer $project_id
 * @property string $name
 * @property string $description
 * @property string $type
 * @property integer $points
 * @property integer $requester
 * @property integer $owner
 * @property string $labels
 * @property integer $iteration
 * @property integer $position
 * @property string $status
 *
 * The followings are the available model relations:
 * @property Project $project
 * @property User $requester0
 * @property User $owner0
 * @property Iteration $iteration0
 * @property StoryActivity[] $storyActivities
 */
class Story extends CActiveRecord
{
    const MAXPOINTS = 10;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Story the static model class
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
        return 'story';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('project_id, name, type, points, requester, owner', 'required'),
            array('project_id, points, requester, owner, iteration, position', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 250),
            array('type', 'length', 'max' => 7),
            array('labels', 'length', 'max' => 200),
            array('status', 'length', 'max' => 11),
            array('description', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, project_id, name, description, type, points, requester, owner, labels, iteration, position, status', 'safe', 'on' => 'search'),
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
            'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
            'requester0' => array(self::BELONGS_TO, 'User', 'requester'),
            'owner0' => array(self::BELONGS_TO, 'User', 'owner'),
            'iteration0' => array(self::BELONGS_TO, 'Iteration', 'iteration'),
            'storyActivities' => array(self::HAS_MANY, 'StoryActivity', 'story_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'project_id' => 'Project',
            'name' => 'Name',
            'description' => 'Description',
            'type' => 'Type',
            'points' => 'Points',
            'requester' => 'Requester',
            'owner' => 'Owner',
            'labels' => 'Labels',
            'iteration' => 'Iteration',
            'position' => 'Position',
            'status' => 'Status',
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
        $criteria->compare('project_id', $this->project_id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('points', $this->points);
        $criteria->compare('requester', $this->requester);
        $criteria->compare('owner', $this->owner);
        $criteria->compare('labels', $this->labels, true);
        $criteria->compare('iteration', $this->iteration);
        $criteria->compare('position', $this->position);
        $criteria->compare('status', $this->status, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getTypeLabels()
    {
        return array(
            'FEATURE' => 'Feature',
            'BUG' => 'Bug',
            'CHORE' => 'Chore',
            'RELEASE' => 'Release'
        );
    }

    public function getPointLabels()
    {
        $pointLabels = array();
        for ($i = 0; $i <= self::MAXPOINTS; $i++) {
            $pointLabels[$i] = $i;
        }

        return $pointLabels;
    }

    protected function afterSave()
    {
        $labels = explode(",", $this->labels);
        foreach ($labels as $label) {
            $label=trim($label);
            $found=Label::model()->find("label=:label", array(":label" => $label));
            if ($found===null) {
                $newLabel=new Label;
                $newLabel->label=$label;
                $newLabel->save();
            }
        }
        return parent::afterSave();
    }

    public function moveToBacklog() {
        $iteration=Iteration::model()->getPlaceForStoryInBacklog($this);
        if ($iteration==null) {
            $iteration=Iteration::model()->createIteration($this->project_id);
        }
        $this->iteration=$iteration->id;
        $this->position=$iteration->getLastPosition();
        $this->save();
    }



}