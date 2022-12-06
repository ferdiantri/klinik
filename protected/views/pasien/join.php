<?php
/* @var $this PasienController */
/* @var $model Pasien */


?>


<?php 
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
        'tanggal_daftar',
        'tanggal_tindakan',
		'nama',
		'wilayah',
		'alamat',
		'jenis_kelamin',
		'umur',
		'keluhan',
        'status',
        'tindakan',
        'nama_obat',
        'dibuat_oleh',
        'harga_obat',
        'total',
	),
));
?>
<h3 align="center"><?php echo CHtml::link('Bayar',array('tindakan/bayar', 'id'=>$model['id']));  ?></h3>

