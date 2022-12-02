<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
if(Yii::app()->user->isGuest){
	$this->redirect(array('site/login'));
}
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>
<?php $cek = User::model()->findByAttributes(array('username'=>Yii::app()->user->name)); ?>
<h3>Heyyyooo!, Selamat datang <?php echo $cek->username; ?> sebagai <?php echo $cek->role; ?>. </h3>

