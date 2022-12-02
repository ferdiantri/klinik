<?php

class PasienController extends Controller
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
	public function accessRules()
	{	
		if(Yii::app()->user->isGuest){
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
	public function actionJoin($id)
	{	
		$user = Yii::app()->db->createCommand()
			->select('p.nama, p.tanggal as tanggal_daftar, o.nama as nama_obat, p.id, p.alamat, p.jenis_kelamin, p.umur, p.keluhan, p.status,
			t.tindakan, t.tanggal as tanggal_tindakan, t.biaya as total, o.dibuat_oleh, o.harga as harga_obat')
			->from('pasien p')
			->join('tindakan t', 'p.id=t.id_pasien')
			->join('obat o', 't.obat=o.id')
			->where('p.id=:id', array(':id'=>$id))
			
			->queryRow();
		$this->render('join',array(
			'model'=>$user,
		));
	}


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Pasien;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Pasien']))
		{	
			$_POST['Pasien']['status'] = 'Belum Ditindak';
			$_POST['Pasien']['tanggal'] = date("Y-m-d h:i:s");
			
			$model->attributes=$_POST['Pasien'];
			if($model->save())
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

		if(isset($_POST['Pasien']))
		{
			$model->attributes=$_POST['Pasien'];
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
		$criteria=new CDbCriteria();
		$criteria->addInCondition('status',array('Belum Ditindak'));

		$dataProvider=new CActiveDataProvider('Pasien',array(
			'criteria'=>$criteria
			// array(
			// 'order'=>'status ASC',
			// )
		));
		// $data=Pasien::model()->findByAttributes(array('status'=>'Belum Ditindak'));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	public function actionSelesai()
	{	
		$criteria=new CDbCriteria();
		$criteria->addInCondition('status',array('Sudah Ditindak'));

		$dataProvider=new CActiveDataProvider('Pasien',array(
			'criteria'=>$criteria
			// array(
			// 'order'=>'status ASC',
			// )
		));
		// $data=Pasien::model()->findByAttributes(array('status'=>'Belum Ditindak'));
		$this->render('selesai',array(
			'dataProvider'=>$dataProvider,
		));
	}


	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Pasien('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Pasien']))
			$model->attributes=$_GET['Pasien'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Pasien the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Pasien::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Pasien $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='pasien-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
