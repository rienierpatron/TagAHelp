
<button class="cn-button" id="cn-button">+</button>
<div class="cn-wrapper" id="cn-wrapper">
    <ul>
      <li><a href="#"></a></li>
      <?php if(Yii::app()->controller->id != "profile"){ ?>
      <li><a href="<?php echo $this->createUrl('profile/index'); ?>" title="Profile"><span class="icon-home"></span></a></li>
      <?php } ?>
      <?php if(Yii::app()->controller->id != "community"){ ?>
      <li><a href="<?php echo $this->createUrl('community/index'); ?>" title="Charities"><span class="icon-group"></span></a></li>
      <?php } ?>
      <?php if(Yii::app()->controller->id != "download"){ ?>
      <li><a href="<?php echo $this->createUrl('download/index'); ?>" title="Download Chat Client"><span class="icon-download"></span></a></li>
      <?php } ?>
      <li><a href="<?php echo $this->createUrl('site/logout'); ?>" title="Logout"><span class="icon-off"></span></a></li>
      <li><a href="#"></a></li>
     </ul>
</div>
<div id="cn-overlay" class="cn-overlay"></div>
<script>
	$(document).ready(function(){
		setTimeout( "jQuery('#flash').slideUp();",3000 );
	});
</script>
