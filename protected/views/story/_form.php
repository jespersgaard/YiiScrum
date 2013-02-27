<?php
/* @var $form TbActiveForm */
/* @var $model Story */

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'story-form',
    'enableAjaxValidation' => false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'name', array('class' => 'span5', 'maxlength' => 250)); ?>

<?php echo $form->redactorRow($model, 'description', array('rows' => 6, 'cols' => 50, 'class' => 'span8')); ?>

<?php echo $form->radioButtonListInlineRow($model, 'type', $model->getTypeLabels()); ?>

<?php echo $form->radioButtonListInlineRow($model, 'points', $model->getPointLabels()); ?>

<?php echo $form->dropDownListRow($model, 'requester', $model->project->getProjectUsersLabels()); ?>

<?php echo $form->dropDownListRow($model, 'owner', $model->project->getProjectUsersLabels()); ?>

<?php echo $form->select2Row($model, 'labels', array('asDropDownList' => false, 'options' => array(
    'model'=>$model,
    'attribute'=>'labels',
    'tags' => Label::getAllLabels(),
    'placeholder' => 'Add label here!',
    'width' => '40%',
    'tokenSeparators' => array(',', ' ')
)));?>

<?php echo $form->textFieldRow($model, 'position', array('class' => 'span5', 'maxlength' => 250)); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => $model->isNewRecord ? 'Create' : 'Save',
    )); ?>
</div>

<?php $this->endWidget(); ?>
