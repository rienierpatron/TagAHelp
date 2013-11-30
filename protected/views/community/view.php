<div class="main_body">
<div id="fb-root"></div>
	<div class="row">
		<div class="col-md-6">
	        <div class="widget-container fluid-height">
	            <div class="heading">
	                <i class="icon-list-alt"></i>Community Details
	                <a href="<?php echo $this->createUrl('community/reviews',array('id'=>$_GET['id'])); ?>" class="btn btn-small btn-danger pull-right">Reviews</a>
	                <a href="#" class="fb-share btn btn-small btn-danger pull-right"><i class="icon-facebook"></i>Share</a>
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
	        <?php $walletCount = 0; ?>
	        <?php for($counter = 0; $counter < sizeOf($wallets['result']); $counter++){
				if($wallets['result'][$counter]['balance_amount'] != 0){
					$walletCount++;
				}
			} ?>
			<?php if($walletCount > 0){ ?>
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
	            					echo "<option value=".$wallets['result'][$counter]['wallet_id']." data-id=".$wallets['result'][$counter]['balance_amount'].">".$wallets['result'][$counter]['wallet_name']." => ".$wallets['result'][$counter]['balance_amount']."</option>";
	            				}
	            			} ?>
	            		</select>
	            		<br/>
	            		<input type="hidden" name="community" value="<?php echo $_GET['id']; ?>">
	            		<input type="text" name="amount" class="form-control" id="amt" placeholder="Enter Amount">
	            		<input type="submit" class="btn btn-danger" id="donate" value="Donate">
	            	</form>
	            </div>
	        </div>
	        <?php }else{ ?>
	        <div class="widget-container fluid-height">
	            <div class="heading">
	                <i class="icon-list-alt"></i>Donate Funds
	            </div>
	            <div class="widget-content padded">
	            	Please add a wallet on your Tagbond account and add funds to enable charity donation.
	            </div>
	        </div>
	        <?php } ?>
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
<script type='text/javascript' src="https://connect.facebook.net/en_US/all.js"></script>
<script>
	$(document).ready(function(){
		$wallet = false;
		$amount = false;
		HELP.map.getLocation("<?php echo $detail['result']['community_address1'].' '.$detail['result']['community_address2'].' '.$detail['result']['community_city'].' '.$_SESSION['country']; ?>","<?php echo $detail['result']['community_name']; ?>");

	});
		
	google.load('visualization', '1.0', {'packages':['corechart']});

	google.setOnLoadCallback(drawChart);

	function drawChart() {
		
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Breakdown');
		data.addColumn('number', 'Percentage');
		data.addRows([
		  <?php echo $funds; ?>
		]);

		var options = {'title':'Where Does your Donations Go?',
		               'height':400};

		var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
		chart.draw(data, options);
		$(window).resize(function(){
			chart.draw(data, options);
		});
	}
     
</script>
<script>
   
   var app_token = '';
   var current_page_token = '';
   var page_id = '';
   var page_name = '';
  
      FB.init({
        appId      : '248159688675364',                        // App ID from the app dashboard
        status     : true,                                 // Check Facebook Login status
        xfbml      : true                                  // Look for social plugins on the page
      });

$(".fb-share").click(function(){

	if(!FB.getLoginStatus()){
		FB.login(function(response) {
			if (response.authResponse) {	            
				app_token = response.authResponse.accessToken;
				post_to_profile();
			} else {
				alert('Cannot continue. Please login');
			}
		},{scope:'manage_pages,publish_stream,read_stream'});
	}
}); 

    function post_to_profile(){
              FB.ui({
                method:'feed',
                name:"<?php echo $detail['result']['community_name']; ?>",
                link: 'http://localhost/tagAhelp/community/details/<?php echo $_GET["id"]; ?>',
                caption:'A Tagbond Community',
                picture:'http://tagbond.com/image/community/<?php echo $_GET["id"]; ?>',
                description:"<?php echo $detail['result']['community_description']; ?>"
              },function(response){
                if(response && response.post_id){
                  alert('Posted');
                }
                else alert('Not Posted');
      })
    }

   


  </script>