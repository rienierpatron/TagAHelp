HELP = {};
HELP.map = {
  getLocation: function(funds){	
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
          funds
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
  }
};