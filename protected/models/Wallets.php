<?php
class Wallets extends CActiveRecord{

	public static function getUserWallets(){
		$walletUrl = "https://api.tagbond.com/wallet/list";
		$walletParams = array(
			'access_token'=>$_SESSION['token']
		);

		$chWallet = curl_init();
		curl_setopt($chWallet, CURLOPT_URL, $walletUrl);
		curl_setopt($chWallet, CURLOPT_POSTFIELDS, $walletParams);
		curl_setopt($chWallet, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($chWallet, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($chWallet, CURLOPT_SSL_VERIFYHOST, FALSE);
		$walletList = json_decode(curl_exec($chWallet),TRUE);
		curl_close($chWallet);

		return $walletList;
	}
}
?>