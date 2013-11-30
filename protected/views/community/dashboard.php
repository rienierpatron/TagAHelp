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
	    	<div class="widget-container fluid-height">
	            <div class="heading">
	                <i class="icon-list-alt"></i>Where Does Donations Go?
	                <input type='button' id='edit-allotment' class='btn btn-xs btn-danger' value='EDIT'></div>
	            </div>
	            <div class="widget-content padded">
	            	<form name="frmFunds" method="POST" action="<?php $this->createUrl('funds/set'); ?>">
	            	<table class="table table-filters" >
		                <tbody id="fund-allotment">
		               		<tr>
		                		<th><b>Particulars</b></th>
		                		<th><b>%</b></th>
		                	</tr>
		                	<tr>
		                		<td>Tagbond(Service Fee)</td>
		                		<td>20</td>
		                	</tr>
		                	<tr>
		                		<td>Others</b></td>
		                		<td>80</td>
		                	</tr>
		                </tbody>
		            </table>
	            	</form>
	            </div>
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


	//Allotment
	var old_allotment = $("#fund-allotment").html();	

	$("#edit-allotment").click(function(){

		var elems = $('#fund-allotment > tr');
		$("#edit-allotment").hide();

		for(i=2;i<elems.length;i++){
			var cell_unit = $(elems[i].cells);

			//allotments[] = cell_unit[1].innerText
			cell_unit[0].innerHTML = '<input type="text" class="form-control col-md-12" value="'+cell_unit[0].innerText+'"/>';
			cell_unit[1].innerHTML = '<input type="text" class="form-control col-md-12" value="'+cell_unit[1].innerText+'"/>';

		}

		
		$("#fund-allotment").after("<input type='button' value='Add new field' id='add-fund-field' class='btn btn-xs btn-info'/><input type='button' value='Save Changes' id='save-field' class='btn btn-xs btn-warning'/> <input type='button' value='Cancel' id='cancel-fund-allotment' class='btn btn-xs btn-primary'/>");
		$("#add-fund-field").click(function(){
			var textfield = '<tr><td><input type="text" class="form-control col-md-12" /></td><td><input type="text" class="form-control col-md-12" /></td></tr>'
			$("#fund-allotment").append(textfield);
		});
		$("#cancel-fund-allotment").click(function(){
			$("#edit-allotment").show();
			$('#add-fund-field,#save-field,#cancel-fund-allotment').remove();
			$("#fund-allotment").empty().append(old_allotment);
		});

		$("#save-field").click(function(){
			var fields = {};
			var elems = $('#fund-allotment > tr');
			
			for(i=2;i<elems.length;i++){
				var cell_unit = $(elems[i].cells);
				
				fields[$(cell_unit[0]).find('input').val()] = $(cell_unit[1]).find('input').val();
				
			}


		console.log(fields);

		});
	})

	
</script>