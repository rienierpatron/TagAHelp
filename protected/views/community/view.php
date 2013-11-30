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
	});
		
	 // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {
      	
        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Breakdown');
        data.addColumn('number', 'Percentage');
        data.addRows([
          <?php echo $funds; ?>
        ]);

        // Set chart options
        var options = {'title':'Where Does your Donations Go?',
                       'height':400};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
         $(window).resize(function(){
		    chart.draw(data, options);
		  });
      }
     
</script>