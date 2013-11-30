<div class="main_body">
	<div class="row">
		<div class="col-md-6">
	        <div class="widget-container fluid-height">
	            <div class="heading">
	                <i class="icon-list-alt"></i>Community List
	            </div>
	            <div class="widget-content padded">
	            	<table class="table table-filters">
		                <tbody>
		                	<?php for($counter = 0; $counter < sizeOf($community); $counter++){ ?>
		                		<?php if($community[$counter]['community_verified'] != 0){ ?>
		                			<?php if($community[$counter]['community_verified'] == 1){ ?>
				                		<tr>
				                			<td class="filter-category green col-md-2">
				                				<i class="icon-money"></i>
						                    	<div class="arrow-left"></div>
						                    </td>
						                    <td class="col-md-10"><?php echo $community[$counter]['community_name']; ?></td>
						                    <td><a href="#businessInfo" data-id="<?php echo $community[$counter]['community_id']; ?>" id="business" class="btn btn-primary">View Info</a></td>
				                		</tr>
				                	<?php }else{ ?>
				                		<tr>
				                			<td class="filter-category red col-md-2">
				                				<i class="icon-heart"></i>
						                    	<div class="arrow-left"></div>
						                    </td>
						                    <td class="col-md-10"><?php echo $community[$counter]['community_name']; ?></td>
						                    <td><a href="#charityInfo" data-id="<?php echo $community[$counter]['community_id']; ?>" id="charity" class="btn btn-primary">View Info</a></td>
				                		</tr>
				                	<?php } ?>
			                	<?php } ?>
		                	<?php } ?>
		                </tbody>
		            </table>
	            </div>
	        </div>
	    </div>
	    <div class="col-md-6" id="businessInfo" style="display:none">
	    	<div class="widget-container fluid-height">
				<div class="heading">
	                <h3><i class="icon-info"></i>Community Details (Business)</h3>
	            </div>
	            <div class="widget-content padded">
	            	
	            </div>
	        </div>
	    </div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('#business').click(function(e){
			var id = $(this).attr('data-id');
			$attr = $(this).attr('href');
			$.ajax({
			url:"https://api.tagbond.com/community/details/"+id,
			type:"POST",
			data:{'access_token':'<?php echo $_SESSION["token"]; ?>'},
			success:function(data){
				console.log(data);
				$('#businessInfo').show();
				e.preventDefault();
				$("body, html").animate({ scrollTop: $($attr).offset().top }, 1000);
				
			},
		})
		
		
		});
	});
</script>