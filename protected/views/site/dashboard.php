<?php
/* @var $this PasienController */
/* @var $data Pasien */
?>

<div class="view">
	<h3>Jumlah Pasien</h3>
    <?php
	$this->widget(
		'chartjs.widgets.ChBars', 
		array(
			'width' => 400,
			'height' => 'auto',
			'htmlOptions' => array(),
			'labels' => array("Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des"),
			'datasets' => array(
				array(
					"fillColor" => "#ff00ff",
					"strokeColor" => "rgba(220,220,220,1)",
					"data" => array(
						$model[0], $model[1], $model[2], $model[3], $model[4], $model[5], $model[6], $model[7], $model[8],
						$model[9], $model[10], $model[11])
				)       
			),
			'options' => array()
		)
	); 
	 ?>
	<h3>Jumlah Pasien Selesai Ditangani</h3>
    <?php
	$this->widget(
		'chartjs.widgets.ChBars', 
		array(
			'width' => 400,
			'height' => 'auto',
			'htmlOptions' => array(),
			'labels' => array("Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des"),
			'datasets' => array(
				array(
					"fillColor" => "#ff00ff",
					"strokeColor" => "rgba(220,220,220,1)",
					"data" => array(
						$model[12], $model[13], $model[14], $model[15], $model[16], $model[17], $model[18], $model[19], $model[20],
						$model[21], $model[22], $model[23])
				)       
			),
			'options' => array()
		)
	); 
	 ?>

	
</div>