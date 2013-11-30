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
		$funds = FundsBreakdown::breakDown($id);
		if($details['result']['community_owner']['id'] == $_SESSION['id']){
			$this->render('dashboard',array('detail'=>$details,'funds'=>$funds));
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
	public function actionSaveDonationRate(){
		$communityId = $_POST['values']['communityId'];
		$rate = $_POST['values']['rate'];
		$name = $_POST['values']['name'];
		if($rate){
			$rateContainer = substr($rate,0);
			if(count($rateContainer)!=0 && $rateContainer!=NULL){
				$rates = explode('=|=', $rateContainer);
			}
		}
		if($name){
			$nameContainer = substr($name,0);
			if(count($nameContainer)!=0 && $nameContainer!=NULL){
				$names = explode('=|=', $nameContainer);
			}
		}
		$funds = FundsBreakdown::model()->findAllByAttributes(array('owner'=>$communityId));
		if($funds){
			$fundsList = Yii::app()->db->createCommand()
			->delete('funds_breakdown',"owner=".$communityId."");
			for($i = 0; $i <=count($rates);$i++){
				$funds = new FundsBreakdown;
				$funds->owner = $communityId;
				$funds->breakdown = $names[$i];
				$funds->percentage = $rates[$i];
				$funds->save();
			}
		}else{
			for($i = 0; $i <=count($rates);$i++){
				$funds = new FundsBreakdown;
				$funds->owner = $communityId;
				$funds->breakdown = $names[$i];
				$funds->percentage = $rates[$i];
				$funds->save();
			}
		}
	}
	public function actionReviews($id){
		if(isset($_POST['review'])){
			$add = Reviews::addReview($_POST['id'],'community',$_POST['review']);
			if($add == "success"){
				Yii::app()->user->setFlash('msg', 'Review posted.');
				Yii::app()->user->setFlash('msgClass', 'alert alert-success');
			}else{
				Yii::app()->user->setFlash('msg', 'Already reviewed.');
				Yii::app()->user->setFlash('msgClass', 'alert alert-danger');
			}
		}
		$reviews = Reviews::getReviews($id,'community');
		$this->render('reviews',array('reviews'=>$reviews));
	}
}
?>