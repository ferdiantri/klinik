<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">
<?php if(Yii::app()->user->hasFlash('error')):?>
	<div class="warning">
		<h1 style="background-color:red;"><?php echo Yii::app()->user->getFlash('error'); ?></h1>
	</div>
<?php endif; ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'role'); ?>
		<?php echo $form->DropDownList($model,
                    'role',
                    array('Pegawai'=>'Pegawai','Admin'=>'Admin'),
                    array('empty'=>'Select Option')
                );; ?>
		<?php echo $form->error($model,'role'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'jenis_kelamin'); ?>
		<?php echo $form->textField($model,'jenis_kelamin',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'jenis_kelamin'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->textField($model,'password',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->