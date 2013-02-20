<?php
$this->breadcrumbs=array(
	'Stories'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Story','url'=>array('index')),
	array('label'=>'Create Story','url'=>array('create')),
	array('label'=>'View Story','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Story','url'=>array('admin')),
);
?>

<h1>Update Story <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>