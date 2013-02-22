<?php
$this->breadcrumbs=array(
    $model->project->title=>array('project/view', 'id'=>$model->project_id),
    $model->id,
);

$this->menu=array(
	array('label'=>'List ProjectMember','url'=>array('index')),
	array('label'=>'Create ProjectMember','url'=>array('create')),
	array('label'=>'Update ProjectMember','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete ProjectMember','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProjectMember','url'=>array('admin')),
);
?>

<h1>View ProjectMember #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'project_id',
		'user_id',
		'role',
	),
)); ?>
