<div class="navbar navbar-fixed-top" role="navigation" style="overflow: visible;">
	<div class="container-fluid top-bar">
    	<a class="logo" href="<?php echo $this->createUrl('profile/index'); ?>"></a>
    	<div class="pull-right" style="margin-top:15px">
    		<a href="#" style="color:white !important"><?php echo $_SESSION['name']; ?></a>
    	</div>
	</div>
	<div class="container-fluid clearfix menubar">

	</div>
</div>
<?php if(Yii::app()->user->hasFlash('msg')): ?>
	<div class="text-center">
	<div class="<?php echo Yii::app()->user->getFlash('msgClass'); ?>" id="flash">
		<?php echo '<i class="icon-info-sign"> </i>'.Yii::app()->user->getFlash('msg') ?>
	</div>
	</div>
<?php endif; ?>
<style>
/*.navi{
	width: 33.35%;
	height:50px;
	border:1px solid #C02C2C;
}
.navi:hover{
	border:1px solid #C02C2C;
}
.menubar{
	width:100% !important;
    position: fixed;
    left: 0;
    right: 0;
    bottom: 0;
    height: 50px;
} */
</style>