<?php

class Communities extends CActiveRecord{

	public static function getCommunities(){
		$getCountryUrl = "http://api.hostip.info/country.php";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $getCountryUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		$country = curl_exec($ch);

		$getCountriesUrl = "https://api.tagbond.com/country/getcountries";
		$params = array(
			'access_token'=>$_SESSION['token']
		);
		$chC = curl_init();
		curl_setopt($chC, CURLOPT_URL, $getCountriesUrl);
		curl_setopt($chC, CURLOPT_POSTFIELDS, $params);
		curl_setopt($chC, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($chC, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($chC, CURLOPT_SSL_VERIFYHOST, FALSE);
		$countryList = json_decode(curl_exec($chC),TRUE);
		curl_close($chC);
		foreach($countryList['result'] as $key => $value){
			if($value['country_code'] == $country){
				$_SESSION['country_id'] = $value['id'];
				$_SESSION['country'] = $value['country_name'];
			}
		}
		
		$getCommunitiesUrl = "https://api.tagbond.com/user/memberof";
		$countryParams = array(
			'access_token'=>$_SESSION['token']
		);

		$chCommunities = curl_init();
		curl_setopt($chCommunities, CURLOPT_URL, $getCommunitiesUrl);
		curl_setopt($chCommunities, CURLOPT_POSTFIELDS, $countryParams);
		curl_setopt($chCommunities, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($chCommunities, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($chCommunities, CURLOPT_SSL_VERIFYHOST, FALSE);
		$communityList = json_decode(curl_exec($chCommunities),TRUE);
		curl_close($chCommunities);
		return $communityList['result'];
	}

	public static function getOwnedCommunities(){
		$getCountryUrl = "http://api.hostip.info/country.php";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $getCountryUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		$country = curl_exec($ch);

		$getCountriesUrl = "https://api.tagbond.com/country/getcountries";
		$params = array(
			'access_token'=>$_SESSION['token']
		);
		$chC = curl_init();
		curl_setopt($chC, CURLOPT_URL, $getCountriesUrl);
		curl_setopt($chC, CURLOPT_POSTFIELDS, $params);
		curl_setopt($chC, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($chC, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($chC, CURLOPT_SSL_VERIFYHOST, FALSE);
		$countryList = json_decode(curl_exec($chC),TRUE);
		curl_close($chC);
		//Common::pre($countryList['result']);exit;
		foreach($countryList['result'] as $key => $value){
			if($value['country_code'] == $country){
				$_SESSION['country_id'] = $value['id'];
				$_SESSION['country'] = $value['country_name'];
			}
		}
		
		$getCommunitiesUrl = "https://api.tagbond.com/user/staffof";
		$countryParams = array(
				'access_token'=>$_SESSION['token']
			);

		$chCommunities = curl_init();
		curl_setopt($chCommunities, CURLOPT_URL, $getCommunitiesUrl);
		curl_setopt($chCommunities, CURLOPT_POSTFIELDS, $countryParams);
		curl_setopt($chCommunities, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($chCommunities, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($chCommunities, CURLOPT_SSL_VERIFYHOST, FALSE);
		$communityList = json_decode(curl_exec($chCommunities),TRUE);
		curl_close($chCommunities);
		return $communityList['result'];	
	}

	public static function getDetails($id){
		$getDetailUrl = "https://api.tagbond.com/community/details/".$id;
		$params = array(
				'access_token'=>$_SESSION['token']
			);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $getDetailUrl);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		$details = json_decode(curl_exec($ch),TRUE);
		curl_close($ch);
		return $details;
	}

}