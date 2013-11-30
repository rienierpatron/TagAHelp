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
	                <i class="icon-list-alt"></i>Location
	            </div>
	            <div class="widget-content padded">
	            	
		                <div id="map-canvas" style="height:500px">
		                </div>
		           
	            </div>
	        </div>
	    </div>
	    <div class="col-md-6">
	    </div>
	</div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true"></script>
<script>
	var geocoder;
	var address = "<?php echo $detail['result']['community_address1'].' '.$detail['result']['community_address2'].' '.$detail['result']['community_city'].' '.$_SESSION['country']; ?>";
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
			    content: '<p style="font-size:12px;"><b>Community: </b><?php echo $detail["result"]["community_name"]; ?><br/><b>Address : </b>'+address+'</p>'
			});
			marker.setAnimation(google.maps.Animation.DROP);
			google.maps.event.addListener(marker, 'click', function() {
			    infowindow.open(marker.get('map'), marker);
			  });
			$('.lat').html("<b>Latitude : </b>"+results[0].geometry.location.lat());
			$('.long').html("<b>Longitude : </b>"+results[0].geometry.location.lng());

	    } else {
	      	$('.map-panel').hide();
	      	$('.coordinates').hide();
	      	$('.location-not-found').show();
	    }
	});
</script>