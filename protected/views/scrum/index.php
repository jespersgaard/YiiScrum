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
            'hideHeader'=>true,
            'columns' => $storyGridColumns,
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
            'dataProvider' => $sprintGridDataProvider,
            'template' => "{items}",
            'hideHeader'=>true,
            'columns' => $storyGridColumns,
        ));
        ?>
        <?php $this->endWidget();?>
    </div>

    <div id="icebox" class="span4">
        <?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
            'title' => 'Icebox <i class="icon-plus"></i>',
        ));?>
        <?php
        $this->widget('bootstrap.widgets.TbGridView', array(
            'dataProvider' => $sprintGridDataProvider,
            'template' => "{items}",
            'hideHeader'=>true,
            'columns' => $storyGridColumns,
        ));
        ?>
        <?php $this->endWidget();?>
    </div>
</div>