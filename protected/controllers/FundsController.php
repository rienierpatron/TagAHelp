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

	public function actionDonate(){
		$url = "https://api.tagbond.com/wallet/transfer";
		$params = array(
			'access_token' => $_SESSION['token'],
			'from_wallet_id' => $_POST['wallet'],
			'to_id' => $_POST['community'],
			'to_type' => 'community',
			'to_wallet_id' => $_POST['wallet'],
			'amount' => $_POST['amount']
		);
		$chTransfer = curl_init();
		curl_setopt($chTransfer, CURLOPT_URL, $url);
		curl_setopt($chTransfer, CURLOPT_POSTFIELDS, $params);
		curl_setopt($chTransfer, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($chTransfer, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($chTransfer, CURLOPT_SSL_VERIFYHOST, FALSE);
		$data = json_decode(curl_exec($chTransfer),TRUE);
		Common::pre($data);
		curl_close($chTransfer);
		Yii::app()->user->setFlash('msg', 'Donation transferred.');
		Yii::app()->user->setFlash('msgClass', 'alert alert-success');
		$this->redirect(array('community/details/'.$_POST['community']));
	}
}
?>