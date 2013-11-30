<?php
session_start();
class ProfileController extends Controller
{
	public function actionIndex(){
		if(isset($_SESSION['token'])){
			$info = Profile::getUserData();
			$wallet = Wallets::getUserWallets();

			$this->render('index',array('info'=>$info,'wallet'=>$wallet));
		}else{
			$this->redirect(array('site/index'));
		}
	}
}
?>