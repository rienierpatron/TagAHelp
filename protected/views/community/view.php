<div class="main_body">
	<div class="row">
		<div class="col-md-6">
	        <div class="widget-container fluid-height">
	            <div class="heading">
	                <i class="icon-list-alt"></i>Community Details
	            </div>
	            <div class="widget-content padded">
	            	<table class="table table-filters">
		                <tbody>
		                	<tr>
		                		<td>
		                			<b>Name</b>
		                		</td>
		                		<td>
		                			<?php echo ": ".$detail['result']['community_name']; ?>
		                		</td>
		                	</tr>
		                	<tr>
		                		<td>
		                			<b>Description</b>
		                		</td>
		                		<td>
		                			<?php echo ": ".$detail['result']['community_description']; ?>
		                		</td>
		                	</tr>
		                </tbody>
		            </table>
	            </div>
	        </div>
	        <div class="widget-container fluid-height">
	            <div class="heading">
	                <i class="icon-list-alt"></i>Donate Funds
	            </div>
	            <div class="widget-content padded">
	            	<form name="frm" method="POST" action="<?php echo $this->createUrl('funds/donate'); ?>">
	            		<label>Select Wallet</label>
	            		<select name="wallet" class="form-control" id="wallet">
	            			<?php for($counter = 0; $counter < sizeOf($wallets['result']); $counter++){
	            				if($wallets['result'][$counter]['balance_amount'] != 0){
	            					echo "<option value=".$wallets['result'][$counter]['wallet_id']." id=".$wallets['result'][$counter]['balance_amount'].">".$wallets['result'][$counter]['wallet_name']." => ".$wallets['result'][$counter]['balance_amount']."</option>";
	            				}
	            			} ?>
	            		</select>
	            		<br/>
	            		<input type="text" class="form-control" placeholder="Enter Amount">
	            		<input type="submit" class="btn btn-danger" value="Donate" style="display:none">
	            	</form>
	            </div>
	        </div>
	        <div class="widget-container fluid-height">
	            <div class="heading">
	                <i class="icon-list-alt"></i>Location
	            </div>
	            <div class="widget-content padded">
	            	
		                <div id="map-canvas" style="height:500px">
		                </div>
		           
	            </div>
	        </div>
	    </div>
	    <div class="col-md-6" id="chart_div">
	    </div>
	</div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script>
	$(document).ready(function(){
		HELP.map.getLocation("<?php echo $detail['result']['community_address1'].' '.$detail['result']['community_address2'].' '.$detail['result']['community_city'].' '.$_SESSION['country']; ?>","<?php echo $detail['result']['community_name']; ?>");
		HELP.graphs.getAllotment('<?php echo $funds; ?>');
	});
</script>