<?php
session_start();
class CommunityController extends Controller
{
	public function actionIndex(){
		if(isset($_SESSION['token'])){
			
			//$communities = Communities::getUserData();
			//$this->render('index',array('info'=>$info));
			$communities = Communities::getCommunities();
			
			
		}else{
			$this->redirect(array('site/index'));
		}
	}
}
?>