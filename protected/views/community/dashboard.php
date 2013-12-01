<div id="fb-root"></div>
<div class="main_body" id="communityDashboard">
	<div class="row">
		<div class="col-md-6">
			<div class="widget-container fluid-height">
				<div class="heading">
	                <i class="icon-list-alt"></i>Community Details
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
									<?php echo $detail['result']['community_name']; ?>
								</td>
							</tr>
							<tr>
								<td>
									<b>Description</b>
								</td>
								<td>
									<?php echo $detail['result']['community_description']; ?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="widget-container fluid-height">
				<div class="heading">
					<i class="icon-map-marker"></i>Location
				</div>
				<div class="widget-content padded">
					<div id="map-canvas" style="height:500px">
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="widget-container fluid-height">
				<div class="heading">
					<i class="icon-info-sign"></i>Where Does Donations Go?
					<input type='button' id='edit-allotment' class='btn btn-danger pull-right' value='Edit'>
					<div class='pull-right computeTotalPercentage' style="display:none">Total: <span class='totalPercentage'></span>%</div>
				</div>
				<div class="widget-content padded">
					<div class="row">
						<form name="frmFunds" method="POST" action="<?php $this->createUrl('funds/set'); ?>">
							<table class="table table-filters" >
								<tbody id="fund-allotment">
									<tr>
										<th><b>Particulars</b></th>
										<th>
											<center>
												<b>Percentage</b>
											</center>
										</th>
										<th></th>
									</tr>
									<tr>
										<td class="fixedDonationName">TAGBOND</td>
										<td>
											<div class="danger alignCenter fixedTagbondValue donationTotalList">
												20
											</div>
										</td>
										<td></td>
									</tr>
									<?php for($i = 0; $i< sizeOf($funds); $i++){
										if($funds[$i]['breakdown'] != "TAGBOND"){?>
											<tr class="donationValues">
												<td><?php echo $funds[$i]['breakdown'];?></td>
												<td>
													<div class="danger alignCenter donationTotalList">
														<?php echo $funds[$i]['percentage'];?>
													</div>
												</td>
												<td></td>
											</tr>
										<?php }
									}?>
									<tr class="displayTotalPercentage">
										<td><b>TOTAL</b></td>
										<td>
											<div class="alignCenter">
												<span class="totalPercentage">20</span>%
											</div>
										</td>
										<td></td>
									</tr>
								</tbody>
							</table>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true"></script>
<script type='text/javascript' src="https://connect.facebook.net/en_US/all.js"></script>
<script>
	$(document).ready(function(){
		var geocoder;
		var address = "<?php echo $detail['result']['community_address1'].' '.$detail['result']['community_address2'].' '.$detail['result']['community_city'].' '.$_SESSION['country']; ?>";
		var community = "<?php echo $detail['result']['community_name']; ?>";
		var map;
		geocoder = new google.maps.Geocoder();
		var mapOptions = {
			zoom: 17,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}
		map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
		geocoder.geocode( { 'address': address}, function(results, status) {
		    if (status == google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location,
					icon: 'http://icons.iconarchive.com/icons/icons-land/vista-map-markers/32/Map-Marker-Marker-Outside-Pink-icon.png',
				});
				var infowindow = new google.maps.InfoWindow({
					maxWidth: 250,
				    content: '<p style="font-size:12px;"><b>Community: </b>'+community+'<br/><b>Address : </b>'+address+'</p>'
				});
				marker.setAnimation(google.maps.Animation.DROP);
				google.maps.event.addListener(marker, 'click', function() {
				    infowindow.open(marker.get('map'), marker);
				  });
				google.maps.event.addDomListener(window, 'resize', function() {
				    map.setCenter(results[0].geometry.location);
				});
		    } else {
		      	$('.location-not-found').show();
		    }
		});
		HELP.community.editDonationDetails();
		HELP.community.removeDonationDetails();
		HELP.community.computeDonationPercentage();
		HELP.community.inputDonationPercentage();
		HELP.community.saveDonationPercentage('<?php echo $_GET["id"];?>',"<?php echo $this->createUrl('community/saveDonationRate'); ?>");
	});	
</script>

<script>
	var app_token = '';
	var current_page_token = '';
	var page_id = '';
	var page_name = '';
  
	FB.init({
		appId      : '248159688675364',                     // App ID from the app dashboard
		status     : true,                                 // Check Facebook Login status
		xfbml      : true                                 // Look for social plugins on the page
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