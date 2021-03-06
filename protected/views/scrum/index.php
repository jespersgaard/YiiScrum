<?php
/* @var $this ScrumController */
/* @var $model Project */
/* @var $currentIteration Iteration */

$this->breadcrumbs = array(
    $model->title,
);
?>
<div id="scrumpanel" class="row">
    <div id="sprint" class="span4">
        <?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
            'title' => "Sprint (Iteration: $currentIteration->id)",
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
<?php
$items = CHtml::listData($iceboxGridDataProvider->getData(), 'id', 'name');
$this->widget('zii.widgets.jui.CJuiSortable',array(
'items'=>$items,
// additional javascript options for the JUI Sortable plugin
'options'=>array(
'delay'=>'300',
),
));
?>