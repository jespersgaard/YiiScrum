<?php
$this->breadcrumbs=array(
	'Projects'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Project','url'=>array('index')),
	array('label'=>'Create Project','url'=>array('create')),
	array('label'=>'Update Project','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Project','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Project','url'=>array('admin')),
    array('label'=>'Add Story','url'=>array('story/create', 'project_id'=>$model->id)),
    array('label'=>'Add Member','url'=>array('projectMember/create', 'project_id'=>$model->id)),
);
?>

<h1>View Project #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'description',
		'start',
		'iteration_length',
		'initial_velocity',
		'create_time',
	),
)); ?>

<h2>Project members</h2>
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'dataProvider' => $membersGridDataProvider,
    'template' => "{items}",
    'columns' => $membersGridColumns,
));
?>

<h2>Project stories</h2>
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'dataProvider' => $backlogGridDataProvider,
    'template' => "{items}",
    'columns' => $backlogGridColumns,
));
?>
