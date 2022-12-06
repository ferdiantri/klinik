<?php

class TindakanController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	// public function accessRules()
	// {
	// 	return array(
	// 		array('allow',  // allow all users to perform 'index' and 'view' actions
	// 			'actions'=>array('index','view'),
	// 			'users'=>array('@'),
	// 		),
	// 		array('allow', // allow authenticated user to perform 'create' and 'update' actions
	// 			'actions'=>array('create','update'),
	// 			'users'=>array('@'),
	// 		),
	// 		array('allow', // allow admin user to perform 'admin' and 'delete' actions
	// 			'actions'=>array('admin','delete'),
	// 			'users'=>array('@'),
	// 		),
	// 		array('deny',  // deny all users
	// 			'users'=>array('*'),
	// 		),
	// 	);
	// }
	public function accessRules()
	{	if(Yii::app()->user->isGuest){
			$this->redirect(array('site/login'));
		}
		$cek = User::model()->findByAttributes(array('username'=>Yii::app()->user->name));
		if($cek->role == 'Admin' OR 'Pegawai'){
			return array(
				array('allow',  // allow all users to perform 'index' and 'view' actions
					'actions'=>array('index','view'),
				),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
			),
				array('allow', // allow admin user to perform 'admin' and 'delete' actions
					'actions'=>array('admin','delete', 'join', 'selesai'),
				),
			);
		}
		else{
			return array(
				array('deny',  // deny all users
					'users'=>array('*'),
				),
			);
		}
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionBayar($id)
	{
		$user = Yii::app()->db->createCommand()
			->select('p.nama, p.tanggal as tanggal_daftar, o.nama as nama_obat, p.id, p.alamat, p.jenis_kelamin, p.umur, p.keluhan, p.status,
			t.tindakan, t.tanggal as tanggal_tindakan, t.biaya as total, o.dibuat_oleh, o.harga as harga_obat, w.wilayah')
			->from('pasien p')
			->join('tindakan t', 'p.id=t.id_pasien')
			->join('obat o', 't.obat=o.id')
			->join('wilayah w', 'p.id_wilayah=w.id')
			->where('p.id=:id', array(':id'=>$id))
			
			->queryRow();
		$this->render('bayar',array(
			'model'=>$user,
		));
        
	}


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Tindakan;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Tindakan']))
		{	
			$check = Obat::model()->findByAttributes(array('id'=>$_POST['Tindakan']['obat']));
			// print_r($model->attributes['biaya']+$check['harga']);
			$tindakan = array(
				'id_pasien' => $_POST['Tindakan']['id_pasien'],
				'tanggal' => date("Y-m-d h:i:s"),
				'tindakan' => $_POST['Tindakan']['tindakan'],
				'obat' => $_POST['Tindakan']['obat'],
				'biaya' => $_POST['Tindakan']['biaya']+$check['harga']
			);
			$model->attributes=$tindakan;
			// print_r($model->attributes=$_POST['Tindakan']['id_pasien']);

			// print_r($tindakan);
	
			if($model->save())
				$post=Pasien::model()->findByPk($_POST['Tindakan']['id_pasien']);
				$post->status = 'Sudah Ditindak';
				$post->save();
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Tindakan']))
		{
			$model->attributes=$_POST['Tindakan'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Tindakan');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Tindakan('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Tindakan']))
			$model->attributes=$_GET['Tindakan'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Tindakan the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Tindakan::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Tindakan $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tindakan-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
