<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'project-member-form',
    'enableAjaxValidation' => false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->dropDownListRow($model, 'user_id', $model->project->getNonProjectUsersLabels()); ?>

<?php echo $form->dropDownListRow($model, 'role', Project::getRoleOptions()); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => $model->isNewRecord ? 'Create' : 'Save',
    )); ?>
</div>

<?php $this->endWidget(); ?>
