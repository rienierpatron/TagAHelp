<?php
session_start();
class FundsController extends Controller
{
	public function actionIndex(){
		if(isset($_SESSION['token'])){
			$owned = Communities::getOwnedCommunities();
			$communities = Communities::getCommunities();
			$this->render('index',array('community'=>$communities,'owned'=>$owned));
		}else{
			$this->redirect(array('site/index'));
		}
	}
	public function actionDashboard($id){
		$details = Communities::getDetails($id);
		$this->render('dashboard',array('detail'=>$details));
	}
	public function actionDetails($id){
		$details = Communities::getDetails($id);
		$getBreakDown = FundsBreakdown::breakDown($id);
		$this->render('view',array('detail'=>$details));
	}
}
?>