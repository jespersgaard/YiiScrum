<?php
/* @var $form TbActiveForm */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'project-form',
    'enableAjaxValidation' => false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'title', array('class' => 'span5', 'maxlength' => 200)); ?>

<?php echo $form->textAreaRow($model, 'description', array('rows' => 6, 'cols' => 50, 'class' => 'span8')); ?>

<?php echo $form->datepickerRow($model, 'start', array('class' => 'span2', 'options' => array('format' => 'yyyy/mm/dd', 'weekStart' => 1), 'prepend' => '<i class="icon-calendar"></i>'
)); ?>

<?php echo $form->dropDownListRow($model, 'iteration_length', array(1 => '1 week', 2 => '2 weeks', 3 => '3 weeks', 4 => '4 weeks'), array('class' => 'span2')); ?>

<?php echo $form->textFieldRow($model, 'initial_velocity', array('class' => 'span1')); ?>


<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => $model->isNewRecord ? 'Create' : 'Save',
    )); ?>
</div>

<?php $this->endWidget(); ?>
