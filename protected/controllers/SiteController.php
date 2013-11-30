<?php
session_start();
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
		if(isset($_GET['code'])){
			$params_string = "";
			$url = 'https://api.tagbond.com/oauth/accesstoken';
			$params = array(
				'client_id'=>'1c1404acc0c82af4',
				'client_secret'=>'15acf21eaaa024c2aa8ddaff28078d7e',
				'grant_type'=>'authorization_code',
				'code'=>$_GET['code'],
				'redirect_uri'=>'http://localhost/TagAHelp/site/index'
			);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
			$data = json_decode(curl_exec($ch),TRUE);
			curl_close($ch);
			if($data['status'] == "success"){
				$_SESSION['token'] = $data['result']['access_token'];
				$this->redirect(array('profile/index'));
			}else{
				Yii::app()->user->setFlash('msg', 'Error while logging in.');
				Yii::app()->user->setFlash('msgClass', 'alert alert-danger');
			}
		}
		if(isset($_SESSION['token'])){
			$this->redirect(array('profile/index'));
		}
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
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		$params_string = "";
		$url = 'https://api.tagbond.com/user/logout/';
		$params = array(
			'access_token'=>$_SESSION['token']
		);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_exec($ch);
		curl_close($ch);
		https://api.tagbond.com/user/logout/
		session_destroy();
		$this->redirect(Yii::app()->homeUrl);
	}
}