<div class="main_body">
	<div class="row">
		<div class="col-md-6">
	        <div class="widget-container fluid-height">
	            <div class="heading">
	                <i class="icon-list-alt"></i>Owned Charities
	            </div>
	            <div class="widget-content padded">
	            	<table class="table table-filters">
		                <tbody>
		                <?php 
		                	$counter1 = 0;
		                	$counter2 = 0;
		                ?>
		                	<?php for($counter = 0; $counter < sizeOf($owned); $counter++){ ?>
		                			<?php if($owned[$counter]['community_verified'] == 2){ ?>
		                			<?php $counter1++; ?>
				                		<tr>
						                    <td class="col-md-10"><?php echo $owned[$counter]['community_name']; ?></td>
						                    <td><a href="<?php echo $this->createUrl('community/dashboard/'.$owned[$counter]['community_id']); ?>" data-id="<?php echo $owned[$counter]['community_id']; ?>" class="btn btn-danger pull-right">View Info</a></td>
				                		</tr>
				                	<?php } ?>
		                	<?php } ?>
		                	<?php if($counter1 == 0){ ?>
		                		<tr><td colspan=2 class="alert alert-danger">No Charities Found.</td></tr>
		                	<?php } ?>
		                </tbody>
		            </table>
	            </div>
	        </div>
	    </div>
		<div class="col-md-6">
	        <div class="widget-container fluid-height">
	            <div class="heading">
	                <i class="icon-list-alt"></i>Joined Charities
	            </div>
	            <div class="widget-content padded">
	            	<table class="table table-filters">
		                <tbody>
		                	<?php for($counter = 0; $counter < sizeOf($community); $counter++){ ?>
		                			<?php if($community[$counter]['community_verified'] == 2){ ?>
		                			<?php $counter2++; ?>
				                		<tr>
						                    <td class="col-md-10"><?php echo $community[$counter]['community_name']; ?></td>
						                    <td><a href="<?php echo $this->createUrl('community/details/'.$community[$counter]['community_id']); ?>" data-id="<?php echo $community[$counter]['community_id']; ?>" class="btn btn-danger pull-right">View Info</a></td>
				                		</tr>
				                	<?php } ?>
		                	<?php } ?>
		                	<?php if($counter2 == 0){ ?>
		                		<tr><td colspan=2 class="alert alert-danger">No Charities Found.</td></tr>
		                	<?php } ?>
		                </tbody>
		            </table>
	            </div>
	        </div>
	    </div>
	</div>
</div>
