<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionDashboard()
	{	
		$sql_1 = "SELECT count(id) FROM pasien WHERE MONTH(tanggal) = 1";
		$r_1 = Yii::app()->db->createCommand($sql_1)->queryScalar();

		$sql_2 = "SELECT count(id) FROM pasien WHERE MONTH(tanggal) = 2";
		$r_2 = Yii::app()->db->createCommand($sql_2)->queryScalar();

		$sql_3 = "SELECT count(id) FROM pasien WHERE MONTH(tanggal) = 3";
		$r_3 = Yii::app()->db->createCommand($sql_3)->queryScalar();

		$sql_4 = "SELECT count(id) FROM pasien WHERE MONTH(tanggal) = 4";
		$r_4 = Yii::app()->db->createCommand($sql_4)->queryScalar();

		$sql_5 = "SELECT count(id) FROM pasien WHERE MONTH(tanggal) = 5";
		$r_5 = Yii::app()->db->createCommand($sql_5)->queryScalar();

		$sql_6 = "SELECT count(id) FROM pasien WHERE MONTH(tanggal) = 6";
		$r_6 = Yii::app()->db->createCommand($sql_6)->queryScalar();

		$sql_7 = "SELECT count(id) FROM pasien WHERE MONTH(tanggal) = 7";
		$r_7 = Yii::app()->db->createCommand($sql_7)->queryScalar();

		$sql_8 = "SELECT count(id) FROM pasien WHERE MONTH(tanggal) = 8";
		$r_8 = Yii::app()->db->createCommand($sql_8)->queryScalar();

		$sql_9 = "SELECT count(id) FROM pasien WHERE MONTH(tanggal) = 9";
		$r_9 = Yii::app()->db->createCommand($sql_9)->queryScalar();

		$sql_10 = "SELECT count(id) FROM pasien WHERE MONTH(tanggal) = 10";
		$r_10 = Yii::app()->db->createCommand($sql_10)->queryScalar();

		$sql_11 = "SELECT count(id) FROM pasien WHERE MONTH(tanggal) = 11";
		$r_11 = Yii::app()->db->createCommand($sql_11)->queryScalar();

		$sql_12 = "SELECT count(id) FROM pasien WHERE MONTH(tanggal) = 12";
		$r_12 = Yii::app()->db->createCommand($sql_12)->queryScalar();

		// Batas

		$rql_1 = "SELECT count(id) FROM pasien WHERE MONTH(tanggal) = 1 AND status = 'Sudah Ditindak'";
		$q_1 = Yii::app()->db->createCommand($rql_1)->queryScalar();

		$rql_2 = "SELECT count(id) FROM pasien WHERE MONTH(tanggal) = 2 AND status = 'Sudah Ditindak'";
		$q_2 = Yii::app()->db->createCommand($rql_2)->queryScalar();

		$rql_3 = "SELECT count(id) FROM pasien WHERE MONTH(tanggal) = 3 AND status = 'Sudah Ditindak'";
		$q_3 = Yii::app()->db->createCommand($rql_3)->queryScalar();

		$rql_4 = "SELECT count(id) FROM pasien WHERE MONTH(tanggal) = 4 AND status = 'Sudah Ditindak'";
		$q_4 = Yii::app()->db->createCommand($rql_4)->queryScalar();

		$rql_5 = "SELECT count(id) FROM pasien WHERE MONTH(tanggal) = 5 AND status = 'Sudah Ditindak'";
		$q_5 = Yii::app()->db->createCommand($rql_5)->queryScalar();

		$rql_6 = "SELECT count(id) FROM pasien WHERE MONTH(tanggal) = 6 AND status = 'Sudah Ditindak'";
		$q_6 = Yii::app()->db->createCommand($rql_6)->queryScalar();

		$rql_7 = "SELECT count(id) FROM pasien WHERE MONTH(tanggal) = 7 AND status = 'Sudah Ditindak'";
		$q_7 = Yii::app()->db->createCommand($rql_7)->queryScalar();

		$rql_8 = "SELECT count(id) FROM pasien WHERE MONTH(tanggal) = 8 AND status = 'Sudah Ditindak'";
		$q_8 = Yii::app()->db->createCommand($rql_8)->queryScalar();

		$rql_9 = "SELECT count(id) FROM pasien WHERE MONTH(tanggal) = 9 AND status = 'Sudah Ditindak'";
		$q_9 = Yii::app()->db->createCommand($rql_9)->queryScalar();

		$rql_10 = "SELECT count(id) FROM pasien WHERE MONTH(tanggal) = 10 AND status = 'Sudah Ditindak'";
		$q_10 = Yii::app()->db->createCommand($rql_10)->queryScalar();

		$rql_11 = "SELECT count(id) FROM pasien WHERE MONTH(tanggal) = 11 AND status = 'Sudah Ditindak'";
		$q_11 = Yii::app()->db->createCommand($rql_11)->queryScalar();

		$rql_12 = "SELECT count(id) FROM pasien WHERE MONTH(tanggal) = 12 AND status = 'Sudah Ditindak'";
		$q_12 = Yii::app()->db->createCommand($rql_12)->queryScalar();

		$data = array(
			$r_1,
			$r_2,
			$r_3,
			$r_4,
			$r_5,
			$r_6,
			$r_7,
			$r_8,
			$r_9,
			$r_10,
			$r_11,
			$r_12,
			$q_1,
			$q_2,
			$q_3,
			$q_4,
			$q_5,
			$q_6,
			$q_7,
			$q_8,
			$q_9,
			$q_10,
			$q_11,
			$q_12
		);
		$this->render('dashboard',array('model'=>$data));
	}
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}