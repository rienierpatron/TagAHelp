<?php

class Reviews extends CActiveRecord{

	public static function getReviews($id,$type){
		$getReviewsUrl = "https://api.tagbond.com/review/list";
		$params = array(
				'access_token'=>$_SESSION['token'],
				'id' => $id,
				'type' => $type
			);

		$chReviews = curl_init();
		curl_setopt($chReviews, CURLOPT_URL, $getReviewsUrl);
		curl_setopt($chReviews, CURLOPT_POSTFIELDS, $params);
		curl_setopt($chReviews, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($chReviews, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($chReviews, CURLOPT_SSL_VERIFYHOST, FALSE);
		$reviews = json_decode(curl_exec($chReviews),TRUE);
		curl_close($chReviews);
		return $reviews['result'];
	}

	public static function addReview($id,$type,$review){
		$addUrl = "https://api.tagbond.com/review/add";
		$params = array(
				'access_token'=>$_SESSION['token'],
				'id' => $id,
				'type' => $type,
				'comment'=>$review,
				'stars'=>5
			);
		$chReviews = curl_init();
		curl_setopt($chReviews, CURLOPT_URL, $addUrl);
		curl_setopt($chReviews, CURLOPT_POSTFIELDS, $params);
		curl_setopt($chReviews, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($chReviews, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($chReviews, CURLOPT_SSL_VERIFYHOST, FALSE);
		$reviews = json_decode(curl_exec($chReviews),TRUE);
		curl_close($chReviews);
		return $reviews['status'];
	}

}