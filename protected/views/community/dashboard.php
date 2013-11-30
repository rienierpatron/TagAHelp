<div class="main_body">
<div id="fb-root"></div>
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
<script type='text/javascript' src="https://connect.facebook.net/en_US/all.js"></script>
<script>
	$(document).ready(function(){
		HELP.map.getLocation("<?php echo $detail['result']['community_address1'].' '.$detail['result']['community_address2'].' '.$detail['result']['community_city'].' '.$_SESSION['country']; ?>","<?php echo $detail['result']['community_name']; ?>");
	});

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
			var total_allotment = 0;
			
			for(i=2;i<elems.length;i++){
				var cell_unit = $(elems[i].cells);
				
				if(!$.isNumeric($(cell_unit[1]).find('input').val())){
					alert('ERROR: Invalid input.\nPlease check the percentage.');
					return;
				}

				if($(cell_unit[0]).find('input').val().length<1){
					alert('ERROR: Invalid input.\nParticular cannot be empty.');
					return;
				}

				total_allotment+=parseInt($(cell_unit[1]).find('input').val());

				fields[$(cell_unit[0]).find('input').val()] = $(cell_unit[1]).find('input').val();
				
			}

				if((total_allotment) > 80){
					alert('Error: Allotment overflow.\nPlease specify the percentage of particulars for a total of 100%');
				}

				if((total_allotment) < 80){
					alert('Error: Insufficient allotment.\nPlease specify the percentage of particulars for a total of s100%');
				}



			/*
			url = location.href;
			url = (url.split('/'));
			id = url[url.length-1];

			$.ajax({
				url:'',
				async:'false',
				data:{
					allotment: fields,
					user_id: id
				},
				success:function(response){
					console.log(response);
				}
			})
			*/


		});



	})

	
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