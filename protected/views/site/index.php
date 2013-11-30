<div class="login-page text-center" id="bgMap">

<img src="<?php echo Yii::app()->theme->baseUrl.'/images/fav32-01.png'; ?>" alt="Tagbond" id="tag_logo" style="width:160px;margin-top:-7px !important;"><a href="#" style="color:#EB3F3C;font-weight:bold;margin-left:-10px !important;margin-top:5px;text-decoration:underline"> A HELP</a>
<br/>
<br/>
<a class="redirect btn btn-danger btn-large text-center" href="https://api.tagbond.com/oauth?client_id=1c1404acc0c82af4&response_type=code&redirect_uri=http://localhost/TagAHelp/site/index&scope=user.credits user.profiles user.communities user.reviews">TAG NOW</a>
</div>
<style>

	.login-page{
		color:#EB3F3C;
		font-size:50px;
		width:100%;
		height:100%;
		background:url('<?php echo Yii::app()->theme->baseUrl."/images/map.png"; ?>');
		border-top:3px solid #EB3F3C;
		border-bottom:3px solid #EB3F3C;
		padding:10px;
	}

	.redirect{
		width:200px !important;
		padding:20px !important;
		background-color:;
	}
	.btn-danger:hover{
		background-color:#EB3F3C !important;
		color:white !important;
		font-weight:bold;
	}

	#bgMap{

	}

</style>


