HELP = {};
HELP.map = {
	getLocation: function(address,community){

		var geocoder;
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
	},
};