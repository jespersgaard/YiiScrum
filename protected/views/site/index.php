<?php
/* @var $this SiteController */
?>

<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Select a project',
));?>
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped',
    'dataProvider' => $projectGridDataProvider,
    'template' => "{items}",
    'hideHeader' => true,
    'columns' => $projectGridColumns,
));
?>
<?php $this->endWidget(); ?>

