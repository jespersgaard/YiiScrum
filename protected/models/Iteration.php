<?php

/**
 * This is the model class for table "iteration".
 *
 * The followings are the available columns in table 'iteration':
 * @property integer $id
 * @property integer $project_id
 * @property integer $num
 * @property integer $team_strength
 *
 * The followings are the available model relations:
 * @property Project $project
 * @property Story[] $stories
 */
class Iteration extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Iteration the static model class
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
            array('project_id, num, team_strength', 'required'),
            array('project_id, num, team_strength', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, project_id, num, team_strength', 'safe', 'on' => 'search'),
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
            'project_id' => 'Project',
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

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('project_id', $this->project_id);
        $criteria->compare('num', $this->num);
        $criteria->compare('team_strength', $this->team_strength);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getPlaceForStoryInBacklog($story)
        /** @var $story Story */
    {
        $velocity = $story->project->initial_velocity;

        $cmd = Yii::app()->db->createCommand();
        $cmd->select = 'iteration.id, iteration.team_strength, SUM(story.points) AS iteration_points';
        $cmd->from = 'iteration';
        $cmd->leftJoin('story', 'story.iteration=iteration.id');
        $cmd->where = "iteration.project_id=$story->project_id";
        $cmd->group = "iteration.id, iteration.team_strength";
        $cmd->having("iteration_points<=$velocity*(iteration.team_strength/100)");
        $cmd->order('num');
        $cmd->limit(1);

        $row = $cmd->queryRow();

        Yii::log($row == null ? 'NULL' : implode(';', $row), CLogger::LEVEL_INFO);
        return $row;
    }

    public function createIteration($project_id)
    {
        $maxNum = $this->getNextIterationNumber($project_id);

        $iteration=new Iteration();
        $iteration->project_id=$project_id;
        $iteration->num=$maxNum;
        $iteration->team_strength=100;
        $iteration->save();

        return $iteration;
    }

    /**
     * @param $project_id
     * @return mixed
     */
    protected function getNextIterationNumber($project_id)
    {
        $cmd = Yii::app()->db->createCommand();
        $cmd->select("MAX(num)");
        $cmd->from("iteration");
        $cmd->where("project_id=$project_id");
        $maxNum = $cmd->queryScalar();
        $maxNum++;
        Yii::log("Next num: $maxNum", CLogger::LEVEL_INFO);
        return $maxNum;
    }

    public function getLastPosition() {

    }


}