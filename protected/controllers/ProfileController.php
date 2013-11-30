<?php
session_start();
class ProfileController extends Controller
{
	public function actionIndex(){
		if(isset($_SESSION['token'])){
			$info = Profile::getUserData();
			Common::pre($info);exit;
			$this->render('index',array('info'=>$info));
		}else{
			$this->redirect(array('site/index'));
		}
	}
}
?>