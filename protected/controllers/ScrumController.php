<?php

class ScrumController extends Controller
{

    public function actionIndex($project_id)
    {
        $model = Project::model()->findByPk($project_id);
        $sprintCriteria = new CDbCriteria();
        $sprintCriteria->addCondition('iteration IS NOT NULL');
        $sprintCriteria->order = 'position';
        $sprintGridDataProvider = new CArrayDataProvider($model->stories($sprintCriteria));
        $sprintGridColumns = array(
            array('name' => 'name',
                'type' => 'raw',
                'value' => 'CHtml::link($data->name, array("story/view","id"=>$data->id,
                "project_id"=>$data->project_id,
                "scrum"=>true))',
            ),
            array('name' => 'type',),
            array('name' => 'points',),
            array('type' => 'raw',
                'value' => 'CHtml::link("<i class=\'icon-hand-right\'></i>", array("moveToBacklog","id"=>$data->id,
                "project_id"=>$data->project_id))',
            ),
        );

        $backlogCriteria = new CDbCriteria();
        $backlogCriteria->addCondition('iteration IS NOT NULL');
        $backlogCriteria->order = 'position';
        $backlogGridDataProvider = new CArrayDataProvider($model->stories($backlogCriteria));

        $backlogGridColumns = array(
            array('name' => 'name',
                'type' => 'raw',
                'value' => 'CHtml::link($data->name, array("story/view","id"=>$data->id,
                "project_id"=>$data->project_id,
                "scrum"=>true))',
            ),
            array('name' => 'type',),
            array('name' => 'points',),
            array('type' => 'raw',
                'value' => 'CHtml::link("<i class=\'icon-hand-left\'></i>", array("moveToSprint","id"=>$data->id,
                "project_id"=>$data->project_id))',
            ),
            array('type' => 'raw',
                'value' => 'CHtml::link("<i class=\'icon-hand-right\'></i>", array("moveToIcebox","id"=>$data->id,
                "project_id"=>$data->project_id))',
            ),

        );

        $iceboxCriteria = new CDbCriteria();
        $iceboxCriteria->addCondition('iteration IS NULL');
        $iceboxCriteria->order = 'position';
        $iceboxGridDataProvider = new CArrayDataProvider($model->stories($iceboxCriteria));
        $iceboxGridColumns = array(
            array('name' => 'name',
                'type' => 'raw',
                'value' => 'CHtml::link($data->name, array("story/view","id"=>$data->id,
                "project_id"=>$data->project_id,
                "scrum"=>true))',
            ),
            array('name' => 'type',),
            array('name' => 'points',),
            array('type' => 'raw',
                'value' => 'CHtml::link("<i class=\'icon-hand-left\'></i>", array("moveToBacklog","id"=>$data->id,
                "project_id"=>$data->project_id))',
            ),
        );

        $this->render('index', array("model" => $model,
            "sprintGridColumns" => $sprintGridColumns,
            "sprintGridDataProvider" => $sprintGridDataProvider,
            "backlogGridColumns" => $backlogGridColumns,
            "backlogGridDataProvider" => $backlogGridDataProvider,
            "iceboxGridColumns" => $iceboxGridColumns,
            "iceboxGridDataProvider" => $iceboxGridDataProvider,


        ));
    }

    public function actionMoveToBacklog($id, $project_id)
    {
        $story = Story::model()->findByPk($id);
        $story->moveToBacklog();

        $this->actionIndex($project_id);
    }

    // Uncomment the following methods and override them if needed
    /*
    public function filters()
    {
        // return the filter configuration for this controller, e.g.:
        return array(
            'inlineFilterName',
            array(
                'class'=>'path.to.FilterClass',
                'propertyName'=>'propertyValue',
            ),
        );
    }

    public function actions()
    {
        // return external action classes, e.g.:
        return array(
            'action1'=>'path.to.ActionClass',
            'action2'=>array(
                'class'=>'path.to.AnotherActionClass',
                'propertyName'=>'propertyValue',
            ),
        );
    }
    */
}