<div class="main_body">
	<div class="row">
		<div class="col-md-12">
			<div class="widget-container fluid-height">
	            <div class="heading">
	                <i class="icon-comment"></i><b>Forum (Charity <?php echo $_GET['id']; ?>)</b>
	            </div>
	            <div class="widget-content padded">
	            	<div class="profile-details">
	            		<form name="frm" method="POST">
				            <textarea name="review" class="form-control" placeholder="Your review here"></textarea>
				            <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
				            <br/>
				            <input type="submit" value="Post" class="btn btn-danger">
			            </form>
			        </div>
	               
	            </div>
	        </div>
		</div>
	</div>
	<?php if(sizeOf($reviews) != 0){ ?>
		<?php for($counter = sizeOf($reviews)-1; $counter > 0; $counter--){ ?>
			<div class="row">
				<div class="col-md-12">
			        <div class="widget-container fluid-height">
			            <div class="heading">
			                <?php echo $reviews[$counter]['sender']; ?>
			                <small class="pull-right"><?php echo $reviews[$counter]['date']; ?></small>
			            </div>
			            <div class="widget-content padded">
			            	<div class="profile-details">
					            <?php echo $reviews[$counter]['comment']; ?>
					        </div>
			            </div>
			        </div>
			    </div>
			</div>
		<?php } ?>
	<?php }else{ ?>
	<div class="row">
		<div class="col-md-12">
	        <div class="alert alert-danger">No reviews yet for this charity.</div>
	    </div>
	</div>
	<?php } ?>
</div>