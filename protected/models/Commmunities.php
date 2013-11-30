<?php

class Communities extends CActiveRecord{

	public static function getUserData(){

		$url = "http://api.hostip.info/country.php";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
			$country = curl_exec($ch);
			$data
	}

}