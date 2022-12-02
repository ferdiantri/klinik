<?php
/* @var $this PasienController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pasiens',
);

$this->menu=array(
	array('label'=>'Create Pasien', 'url'=>array('create')),
	array('label'=>'Manage Pasien', 'url'=>array('admin')),
);
?>

<h1>Pasiens(Belum Ditindak)</h1>
<b><?php echo CHtml::link('Sudah Ditindak',array('pasien/selesai'));?></b>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 
