<?php

class Common {

	public static function displayError($message){
		if(is_array($message)){
			$error = "<div class='alert alert-error'><ul>";
			foreach ($message as $value) {
				$error .= "<li>".$value."</li>";
			}
			$error .= "</ul></div>";
			echo $error;
		}else{
			echo "<div class='alert alert-error'>".$message."</div>";
		}
	}

	public static function displaySuccess($message){
		echo "<div class='alert alert-success'>".$message."</div>";
	}

	public static function displayWarning($message){
		echo "<div class='alert alert-warning'>".$message."</div>";
	}

	public static function displayInfo($message){
		echo "<div class='alert alert-info'>".$message."</div>";
	}

	public static function displayFlash($messageArray){
		if($messageArray){
			foreach($messageArray as $key=>$message){
				if($key == 'success'){
					self::displaySuccess($message);
				}
				elseif($key == 'notice'){
					self::displayWarning($message);
				}
				elseif($key == 'error'){
					self::displayError($message);
				}
				elseif($key == 'info'){
					self::displayInfo($message);
				}
			}
		}
	}

	public static function flashError($message){
		Yii::app()->user->setFlash('msg', $message);
		Yii::app()->user->setFlash('msgClass', 'alert alert-error');
	}

	public static function pre($obj,$exit = false){
		echo "<pre>";
		print_r($obj);
		echo "</pre>";
		
		if($exit){
			exit();
		}
	}

	public static function showFile($fileName,$content,$mimeType=null,$terminate=true){
			if($mimeType===null)
			{
					if(($mimeType=CFileHelper::getMimeTypeByExtension($fileName))===null)
							$mimeType='text/plain';
			}
			header('Pragma: public');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header("Content-type: $mimeType");
			if(ob_get_length()===false)
					header('Content-Length: '.(function_exists('mb_strlen') ? mb_strlen($content,'8bit') : strlen($content)));
			header("Content-Disposition: inline; filename=\"$fileName\"");
			header('Content-Transfer-Encoding: binary');

			if($terminate)
			{
					// clean up the application first because the file downloading could take long time
					// which may cause timeout of some resources (such as DB connection)
					Yii::app()->end(0,false);
					echo $content;
					exit(0);
			}
			else
					echo $content;
	}

	public static function disableYiiLog(){
		foreach (Yii::app()->log->routes as $route){
			if ($route instanceof CWebLogRoute || $route instanceof CFileLogRoute || $route instanceof YiiDebugToolbarRoute)
			{
					$route->enabled = false;
			}
		} 
	}

	public static function getGender(){
		return array('1'=>Yii::t("labels","Male"),'2' => Yii::t("labels","Female"));
	}

	public static function notify($message, $status = NULL){
		Yii::app()->user->setFlash('msg', Yii::t('labels',$message));
		Yii::app()->user->setFlash('msgClass', 'alert alert-'.$status);
	}
}
?>