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
		                	<?php for($counter = 0; $counter < sizeOf($community); $counter++){ ?>
		                			<?php if($community[$counter]['community_verified'] == 2){ ?>
				                		<tr>
				                			<td class="filter-category red col-md-2">
				                				<i class="icon-heart"></i>
						                    	<div class="arrow-left"></div>
						                    </td>
						                    <td class="col-md-10"><?php echo $community[$counter]['community_name']; ?></td>
						                    <td><a href="<?php echo $this->createUrl('community/details/'.$community[$counter]['community_id']); ?>" data-id="<?php echo $community[$counter]['community_id']; ?>" class="btn btn-primary">View Info</a></td>
				                		</tr>
				                	<?php } ?>
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
				                		<tr>
				                			<td class="filter-category red col-md-2">
				                				<i class="icon-heart"></i>
						                    	<div class="arrow-left"></div>
						                    </td>
						                    <td class="col-md-10"><?php echo $community[$counter]['community_name']; ?></td>
						                    <td><a href="<?php echo $this->createUrl('community/details/'.$community[$counter]['community_id']); ?>" data-id="<?php echo $community[$counter]['community_id']; ?>" class="btn btn-primary">View Info</a></td>
				                		</tr>
				                	<?php } ?>
		                	<?php } ?>
		                </tbody>
		            </table>
	            </div>
	        </div>
	    </div>
	</div>
</div>
