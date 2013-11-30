<div class="main_body">
	<?php $userInfo = $info['result']; ?>
	<div class="row">
		<div class="col-md-6">
	        <div class="widget-container fluid-height">
	            <div class="heading">
	                <i class="icon-list-alt"></i>Info
	            </div>
	            <div class="widget-content padded">
	            	<div class="profile-details">
			            <h2><?php echo $userInfo['user_firstname']." ".$userInfo['user_lastname']." - ".$userInfo['id']; ?></h2>
			        </div>
	               
	            </div>
	        </div>
	    </div>
	</div>
</div>