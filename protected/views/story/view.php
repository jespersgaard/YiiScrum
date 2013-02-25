<?php
/*  @var $model Story   */
$this->breadcrumbs=array(
	$model->project->title=>array('project/view', 'id'=>$model->project_id),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Story','url'=>array('index')),
	array('label'=>'Create Story','url'=>array('create')),
	array('label'=>'Update Story','url'=>array('update','id'=>$model->id, 'project_id'=>$model->project_id, 'scrum'=>$scrum)),
	array('label'=>'Delete Story','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Story','url'=>array('admin')),
);
?>

<h1>View Story #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'project_id',
		'name',
		'description',
		'type',
		'points',
		'requester',
		'owner',
		'labels',
		'iteration',
		'position',
		'status',
	),
)); ?>
