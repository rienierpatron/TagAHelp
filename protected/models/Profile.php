<?php

class Profile extends CActiveRecord{

	public static function getUserData(){

		$url = "https://api.tagbond.com/user/profile?access_token=".$_SESSION['token']."";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		$data = json_decode(curl_exec($ch),TRUE);
		//Common::pre($data);
		$_SESSION['name'] = $data['result']['user_firstname']." ".$data['result']['user_lastname'];
		$_SESSION['id'] = $data['result']['id'];

		return $data;
	}

}