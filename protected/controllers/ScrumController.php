<?php

class ScrumController extends Controller
{

    public function actionIndex($project_id)
    {
        $model = Project::model()->findByPk($project_id);

        $sprintGridDataProvider = new CArrayDataProvider($model->stories);
        $storyGridColumns = array(
            array('name' => 'name',
                'type'=>'raw',
                'value'=>'CHtml::link($data->name, array("story/view","id"=>$data->id,
                "project_id"=>$data->project_id,
                "scrum"=>true))',
            ),
            array('name' => 'type', ),
            array('name' => 'points',),
            array('name' => 'name',
                'type'=>'raw',
                'value'=>'CHtml::link("<i class=\'icon-hand-left\'></i>", array("moveToBacklog","id"=>$data->id,
                "project_id"=>$data->project_id))',
            ),
        );

        $this->render('index', array("model" => $model, "storyGridColumns" => $storyGridColumns,
            "sprintGridDataProvider" => $sprintGridDataProvider));
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