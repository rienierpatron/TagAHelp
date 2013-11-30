<?php
session_start();
class CommunityController extends Controller
{
	public function actionIndex(){
		if(isset($_SESSION['token'])){
			
			$communities = Communities::getCommunities();
			$this->render('index',array('community'=>$communities));
		}else{
			$this->redirect(array('site/index'));
		}
	}
	public function actionDetails($id){
		$details = Communities::getDetails($id);
		$this->render('view',array('detail'=>$details));
	}
}
?>