<?php
/* @var $this PasienController */
/* @var $data Pasien */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tanggal_daftar')); ?>:</b>
	<?php echo CHtml::encode($data->tanggal_daftar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tanggal_tindakan')); ?>:</b>
	<?php echo CHtml::encode($data->tanggal_tindakan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama')); ?>:</b>
	<?php echo CHtml::encode($data->nama); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alamat')); ?>:</b>
	<?php echo CHtml::encode($data->alamat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jenis_kelamin')); ?>:</b>
	<?php echo CHtml::encode($data->jenis_kelamin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('umur')); ?>:</b>
	<?php echo CHtml::encode($data->umur); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('keluhan')); ?>:</b>
	<?php echo CHtml::encode($data->keluhan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />
    <b><?php echo CHtml::encode($data->getAttributeLabel('obat')); ?>:</b>
	<?php echo CHtml::encode($data->obat); ?>
	<br />

	<?php
	if (CHtml::encode($data->status) == 'Belum Ditindak'){
		echo CHtml::link('Proses Tindakan',array('tindakan/create', 'id'=>$data->id));
	}
	 ?>


</div>