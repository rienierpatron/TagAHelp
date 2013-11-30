<?php
session_start();
class ProfileController extends Controller
{
	public function actionIndex(){
		if(isset($_SESSION['token'])){
			$url = "https://api.tagbond.com/user/profile?access_token=".$_SESSION['token']."";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
			$data = json_decode(curl_exec($ch),TRUE);
			//Common::pre($data);
			$_SESSION['id'] = $data['result']['id'];
			$this->render('index',array('info'=>$data));
			
		}else{
			$this->redirect(array('site/index'));
		}
	}
}
?>