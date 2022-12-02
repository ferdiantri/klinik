<?php
/* @var $this PasienController */
/* @var $model Pasien */


?>



<?php $this->widget('zii.widgets.CDetailView', array(

	'data'=>$model,
	'attributes'=>array(
		'id',
        'tanggal_daftar',
        'tanggal_tindakan',
		'nama',
		'alamat',
		'jenis_kelamin',
		'umur',
		'keluhan',
        'status',
        'tindakan',
        'nama_obat',
        'dibuat_oleh',
        'harga_obat',
        'total'
	),
)); ?>
