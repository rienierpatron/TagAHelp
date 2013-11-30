<?php
session_start();
class ProfileController extends Controller
{
	public function actionIndex(){
		if(isset($_SESSION['token'])){
			
			$info = Profile::getUserData();
			$this->render('index',array('info'=>$info));
			
		}else{
			$this->redirect(array('site/index'));
		}
	}
}
?>