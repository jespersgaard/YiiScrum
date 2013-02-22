<?php

class ScrumController extends Controller
{

    public function actionIndex($project_id)
    {
        $model = Project::model()->findByPk($project_id);

        $sprintGridDataProvider = new CArrayDataProvider($model->stories);
        $storyGridColumns = array(
            array('name' => 'name', 'header' => 'Name'),
            array('name' => 'type', 'header' => 'Type'),
            array('name' => 'points', 'header' => 'Points'),
            array(
                'htmlOptions' => array('nowrap' => 'nowrap'),
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'template' => '',
                'viewButtonUrl' => 'Yii::app()->urlManager->createUrl("story/view", array("id"=>$data->id))'
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