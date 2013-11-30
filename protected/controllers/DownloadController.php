<?php
session_start();
class DownloadController extends Controller
{
	public function actionIndex(){
		$this->render('index');
	}
}
?>