<div class="navbar navbar-fixed-top" role="navigation" style="overflow: visible;">
	<div class="container-fluid top-bar">
    	<a class="logo" href="<?php echo $this->createUrl('profile/index'); ?>"></a>
    	<div class="pull-right" style="margin-top:15px">
    		<a href="<?php echo $this->createUrl('site/logout'); ?>"><i class="icon-power-off" style="color:white"></i></a>
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