<?php
/* @var $this ScrumController */
/* @var $model Project */

$this->breadcrumbs = array(
    $model->title,
);
?>
<div id="scrumpanel" class="row">
    <div id="sprint" class="span4">
        <?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
            'title' => 'Sprint',
        ));?>

        <?php
        $this->widget('bootstrap.widgets.TbGridView', array(
            'dataProvider' => $sprintGridDataProvider,
            'template' => "{items}",
            'hideHeader' => true,
            'columns' => $sprintGridColumns,
        ));
        ?>

        <?php $this->endWidget();?>
    </div>

    <div id="backlog" class="span4">
        <?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
            'title' => 'Backlog',
        ));?>
        <?php
        $this->widget('bootstrap.widgets.TbGridView', array(
            'dataProvider' => $backlogGridDataProvider,
            'template' => "{items}",
            'hideHeader' => true,
            'columns' => $backlogGridColumns,
        ));
        ?>
        <?php $this->endWidget();?>
    </div>

    <div id="icebox" class="span4">
        <?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
            'title' => 'Icebox',
            'headerButtons' => array(
                array(
                    'class' => 'bootstrap.widgets.TbButton',
                    'label' => 'New',
                    'icon' =>'icon-plus',
                    'url' => array('story/create', 'project_id'=>$model->id, 'scrum'=>true),
                ),

            ),


        ));?>
        <?php
        $this->widget('bootstrap.widgets.TbGridView', array(
            'dataProvider' => $iceboxGridDataProvider,
            'template' => "{items}",
            'hideHeader' => true,
            'columns' => $iceboxGridColumns,
        ));
        ?>
        <?php $this->endWidget();?>
    </div>
</div>