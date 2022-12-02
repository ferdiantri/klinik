<?php
/* @var $this TindakanController */
/* @var $model Tindakan */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tindakan-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<!-- <?php print_r($_GET['id']); ?> -->
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_pasien'); ?>
		<?php echo $form->textField($model,'id_pasien', array('value' => $_GET['id'])); ?>
		<?php echo $form->error($model,'id_pasien'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tindakan'); ?>
		<?php echo $form->textField($model,'tindakan',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'tindakan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'obat'); ?>
		<?php echo $form->dropDownList($model,'obat', CHtml::listData(Obat::model()->findAll(),'id','nama')); ?>
		<?php echo $form->error($model,'obat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'biaya'); ?>
		<?php echo $form->textField($model,'biaya'); ?>
		<?php echo $form->error($model,'biaya'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->