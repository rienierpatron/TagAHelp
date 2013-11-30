<?php
session_start();
class CommunityController extends Controller
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
		if($details['result']['community_owner']['id'] == $_SESSION['id']){
			$this->render('dashboard',array('detail'=>$details));
		}else{
			$this->redirect(array('community/dashboard/'.$id));
		}
		
	}
	public function actionDetails($id){
		$details = Communities::getDetails($id);

		$funds = FundsBreakdown::breakDown($id);
		$wallets = Wallets::getUserWallets();
		$fund = "";
		for($i = 0; $i< sizeOf($funds); $i++){
			if($i == 0){
				$fund = "['".$funds[$i]["breakdown"]."',".$funds[$i]["percentage"]."]";
			}else{
				$fund = $fund.",['".$funds[$i]["breakdown"]."',".$funds[$i]["percentage"]."]";
			}
		}
		if($details['result']['community_owner']['id'] == $_SESSION['id']){
			$this->redirect(array('community/dashboard/'.$id));
		}else{
			$this->render('view',array('detail'=>$details,'funds'=>$fund,'wallets'=>$wallets));
		}
	}
}
?>